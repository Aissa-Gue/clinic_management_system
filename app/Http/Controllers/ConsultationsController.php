<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Consultation;

class ConsultationsController extends Controller
{
    public function showData($doc_id){

        return view('consultations.consultations')
            ->with('doctor',Doctor::all('id','first_name','last_name','spec_id'))
            ->with('currentDoc',Doctor::all('id','first_name','last_name')->where('id',$doc_id)->first())
            ->with('appointment',Appointment::where('doc_id', $doc_id)->where('date', Carbon::today())->doesntHave('consultation')->get())
            ->with('consultation',Consultation::all()->where('appointment.doc_id',$doc_id)->sortByDesc('created_at'));
    }

    public function show($app_id){
        return view('consultations.preview_consultation')
            ->with('consultation',Consultation::all()->where('app_id',$app_id)->sortByDesc('created_at'));
    }
    public function history($app_id){
        $currentPat = Appointment::where('id',$app_id)->first('pat_id');
        $currentApp = Appointment::where('id',$app_id)->get();

        return view('consultations.history')
            ->with('currentApp',$currentApp)
            ->with('appointments',Appointment::where('pat_id',$currentPat['pat_id'])->whereHas('consultation')->get());
    }


    public function add_cons_redirect(){
        $app_id = explode(' - ', request('patient'));
        //dosent work in this moment
        $validator = Validator::make(
            array('app_id' => $app_id[0]),
            array('app_id' => 'required|numeric|:appointments'));

        if ($validator->fails()) {
            $messages = $validator->messages();
            return redirect('consultations/' . $app_id[0])->with('messages', $messages);
        }else{
            return redirect('consultations/add/'.$app_id[0]);
        }
    }

    function insert_consultation($app_id){
        return view('consultations.add_consultation')
            ->with('currentApp',Appointment::where('id',$app_id)->get())
            ->with('currentDoc',Appointment::all('doc_id')->where('id',$app_id)->first())
            ->with('doctor',Doctor::all());
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
            return view('consultations.add_consultation')->with('messages',$messages)
                ->with('currentApp',Appointment::where('id',$app_id)->get())
                ->with('currentDoc',Appointment::all('doc_id')->where('id',$app_id)->first())
                ->with('doctor',Doctor::all());

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
            return view('consultations.edit_consultation')->with('messages',$messages)
                ->with('consultation',Consultation::all()->where('app_id',$app_id));

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
        $appointment = Appointment::where('id', '=', $app_id)->first();
        Consultation::where('app_id', '=', $app_id)->delete();
        return redirect('consultations/'.$appointment['doc_id']);
    }
}