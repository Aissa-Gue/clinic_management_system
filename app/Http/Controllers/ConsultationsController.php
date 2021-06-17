<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Carbon\Carbon;

use App\Models\Patient;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Consultation;


class ConsultationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showData($doc_id){
        if(Auth::id() === 1) { //manager only
            return view('consultations.consultations')
                ->with('doctor', User::where('id', '>', 2)->get())
                ->with('currentDoc', User::where('id', $doc_id)->first())
                ->with('appointment', Appointment::where('doc_id', $doc_id)->where('date', Carbon::today())->doesntHave('consultation')->get())
                ->with('consultation', Consultation::join('appointments', 'appointments.id', 'consultations.app_id')->where('appointments.doc_id', $doc_id)->whereDate('appointments.date', Carbon::today())->orderByDesc('appointments.date')->get());
        }elseif(Auth::id() > 2){ //doctors only
            if($doc_id != Auth::id()){
                return redirect('consultations/'.Auth::id());
            }
            return view('consultations.consultations')
                ->with('doctor', User::where('id', Auth::id())->get())
                ->with('currentDoc', User::where('id', $doc_id)->first())
                ->with('appointment', Appointment::where('doc_id', $doc_id)->where('date', Carbon::today())->doesntHave('consultation')->get())
                ->with('consultation', Consultation::join('appointments', 'appointments.id', 'consultations.app_id')->where('appointments.doc_id', $doc_id)->whereDate('appointments.date', Carbon::today())->orderByDesc('appointments.date')->get());
        }
    }

    public function show($app_id){
        return view('consultations.preview_consultation')
            ->with('consultation',Consultation::all()->where('app_id',$app_id)->sortByDesc('created_at'));
    }
    public function history($app_id){
        $currentPat = Appointment::where('id',$app_id)->first();
        $currentApp = Appointment::where('id',$app_id)->get();

        return view('consultations.history')
            ->with('currentApp',$currentApp)
            ->with('appointments',Appointment::where('pat_id',$currentPat['pat_id'])
                                            ->where('doc_id',$currentPat['doc_id'])
                                            ->whereHas('consultation')->get());
    }


    public function add_cons_redirect(Request $req){
        $app_id = explode(' - ', $req->patient);
        $validator = Validator::make(
            array('patient' => $app_id[0]),
            array('patient' => 'required|numeric'));

        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()->with('error', 'The patient field is required !');   ;
            //return redirect('consultations/' . Auth::id())->with('messages', $messages);
        }else{
            return redirect('consultations/add/'.$app_id[0]);
        }
    }

    function insert_consultation($app_id){
        return view('consultations.add_consultation')
            ->with('currentApp',Appointment::where('id',$app_id)->get())
            ->with('currentDoc',Appointment::all('doc_id')->where('id',$app_id)->first())
            ->with('doctor',User::where('id','>',2));
    }

    public function store($app_id){
        $validator = Validator::make(
            array(
                'app_id' => $app_id,
                'doc_id' => request('doc_id'),
                'pat_id' => request('pat_id'),
                'blood_type' => request('blood_type'),
                'weight' => request('weight'),
                'length' => request('length'),
                'temperature' => request('temperature'),
                'paid_amount' => request('paid_amount'),
                'description' => request('description')
            ),
            array(
                'app_id' => 'required|unique:consultations',
                'doc_id' => 'required',
                'pat_id' => 'required',
                'blood_type' => 'max:3',
                'weight' => 'numeric|between:0,200',
                'length' => 'numeric|between:0,230',
                'temperature' => 'numeric|between:30,45',
                'paid_amount' => 'required|numeric|between:0,900000',
                'description' => 'required'
            )
        );
        if ($validator->fails()){
            $messages = $validator->messages();
            return $this->insert_consultation($app_id)->with('messages',$messages);

        }else{
            $consultation = new Consultation();
            $consultation->app_id = $app_id;
            $consultation->paid_amount = request('paid_amount');
            $consultation->weight = request('weight');
            $consultation->length = request('length');
            $consultation->temperature = request('temperature');
            $consultation->description = request('description');
            $consultation->save();

            //update patient info
            $pat_id = request('pat_id');
            $blood_type = request('blood_type');
            $blood_pressure = request('blood_pressure');
            $diabetes = request('diabetes');

            Patient::where('id', '=', $pat_id)
                ->update([
                    'blood_type' => $blood_type,
                    'blood_pressure' => $blood_pressure,
                    'diabetes' => $diabetes
                ]);

            //$doc_id = request('doc_id');
            return redirect('consultations/prescriptions/'.$app_id);
        }
    }

    public function update_consultation($app_id){
        return view('consultations.edit_consultation')
            ->with('consultation',Consultation::all()->where('app_id',$app_id));
    }

    public function update($app_id, Request $req){
        $validator = Validator::make(
            array(
                'app_id' => $app_id,
                'doc_id' => $req->doc_id,
                'pat_id' => $req->pat_id,
                'blood_type' => $req->blood_type,
                'weight' => $req->weight,
                'length' => $req->length,
                'temperature' => $req->temperature,
                'paid_amount' => $req->paid_amount,
                'description' => $req->description
            ),
            array(
                'app_id' => 'required',
                'doc_id' => 'required',
                'pat_id' => 'required',
                'blood_type' => 'max:3',
                'weight' => 'numeric|between:0,200',
                'length' => 'numeric|between:0,230',
                'temperature' => 'numeric|between:30,45',
                'paid_amount' => 'required|numeric|between:0,900000',
                'description' => 'required'
            )
        );
        if ($validator->fails()){
            $messages = $validator->messages();
            return $this->update_consultation($app_id)->with('messages',$messages);

        }else {
            //update patient info
            $pat_id = $req->pat_id;
            //$doc_id = $req->doc_id;

            Patient::where('id', '=', $pat_id)
                ->update([
                    'blood_type' => $req->blood_type,
                    'blood_pressure' => $req->blood_pressure,
                    'diabetes' => $req->diabetes
                ]);

            //update Consultation info
            Consultation::where('app_id', '=', $app_id)
                ->update([
                    'paid_amount' => $req->paid_amount,
                    'weight' => $req->weight,
                    'length' => $req->length,
                    'temperature' => $req->temperature,
                    'description' => $req->description,
                ]);

            return redirect('consultations/prescriptions/'.$app_id);
        }
    }

    public function destroy($app_id){

        //Delete prescription & certificate
        $pres_cert= Appointment::join('consultations','appointments.id','=','consultations.app_id')
            ->where('app_id', $app_id)
            ->select('pres_id','cert_id','doc_id')
            ->first();
        if($pres_cert['pres_id'] != null){
            Prescription::where('id',$pres_cert['pres_id'])->delete();
        }
        if($pres_cert['cert_id'] != null){
            Certificate::where('id',$pres_cert['cert_id'])->delete();
        }

        //Delete consultations
        Consultation::where('app_id', $app_id)->delete();
        return redirect('consultations/'.$pres_cert['doc_id']);
    }


    /*********** Medical Records *************/

    public function medicalRecords($doc_id, Request $request){
        if($doc_id != Auth::id()){
            return redirect('medical_records/'.Auth::id());
        }

        $first_name = $request->get('fname');
        $last_name = $request->get('lname');

        $cons_records= Patient::join('appointments','patients.id','=','appointments.pat_id')
            ->join('consultations','appointments.id','=','consultations.app_id')
            ->where('first_name','LIKE','%'.$first_name.'%')
            ->where('last_name','LIKE','%'.$last_name.'%')
            ->where('doc_id',$doc_id)
            ->groupBy('pat_id')
            ->select('pat_id','first_name','last_name','birthdate','date','app_id',DB::raw('COUNT(*) as cons_nbr'))
            ->get();

        return view('consultations.medical_records')
            ->with('doctor', User::where('id', Auth::id())->get())
            ->with('currentDoc', User::where('id', $doc_id)->first())
            ->with('cons_records', $cons_records);
    }

    public function PatientHistory($app_id){
        $currentApp = Appointment::where('id',$app_id)->first();

        return view('consultations.patient_history')
            ->with('currentApp',$currentApp)
            ->with('appointments',Appointment::where('pat_id',$currentApp['pat_id'])
                ->where('doc_id',$currentApp['doc_id'])
                ->whereHas('consultation')->get());
    }

    /*********** END Medical Records *************/

}
