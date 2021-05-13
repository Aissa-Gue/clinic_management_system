<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            ->with('appointment',Appointment::all()->where('doc_id',$doc_id))
            ->with('consultation',Consultation::all()->where('appointment.doc_id',$doc_id)->sortByDesc('created_at'));
    }

    public function add_cons_redirect(){
        $app_id = explode(' - ', request('patient'));
        return redirect('consultations/add/'.$app_id[0]);
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

            $doc_id = request('doc_id');
            return redirect('consultations/'.$doc_id);
        }
    }

    public function destroy($cons_id){
        $consultation = Consultation::where('id', '=', $cons_id)->delete();
        return redirect('consultations/'.$consultation->appointment->doc_id);
    }
}
