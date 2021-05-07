<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Validator;
use Redirect;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Specialisation;
use App\Models\Patient;
use App\Models\Agenda;


class AppointmentsController extends Controller
{
    public function showAllData(){
        return view('appointments.appointments')
            ->with('appointment',Appointment::all())
            ->with('patient',Patient::all())
            ->with('doctor',Doctor::all())
            ->with('agenda',Agenda::all());
    }


    public function showSpeciality($doc_id){
        $agenda = DB::table('agendas')
            ->WhereNotExists(function ($query) use ($doc_id){
                $query->select(DB::raw(1))
                    ->from('appointments')
                    ->whereColumn('appointments.time','=','agendas.time')
                    ->where('doc_id','=',$doc_id);
            })
            ->select('agendas.time')
            ->get();

        return view('appointments.appointments')
            ->with('appointment',Appointment::all()->where('doc_id','=',$doc_id)->sortByDesc('time')->sortByDesc('date'))
            ->with('patient',Patient::all('id','first_name','last_name'))
            ->with('doctor',Doctor::all('id','first_name','last_name','spec_id'))
            ->with('currentDoc',Doctor::all('id','first_name','last_name')->where('id',$doc_id)->first())
            ->with('agenda',$agenda)
            ->with('speciality',Specialisation::all());
    }


    public function store(){
        $patient_name = explode(' - ' ,request('patient_name'));
        $doc_id = request('doctor_id');

        $validator = Validator::make(
            array(
                'patient_id' => $patient_name[0],
                'doctor_id' => request('doctor_id'),
                'date' => request('date'),
                'time' => request('time')
            ),
            array(
                'patient_id' => 'required|numeric:appointments',
                'doctor_id' => 'required|numeric:appointments',
                'date' => 'required|date:appointments',
                'time' => 'required|date_format:H:i|:appointments'
            )
        );
        if ($validator->fails())
        {
            //$messages = $validator->messages();
            return Redirect::to('appointments/'.$doc_id)->withErrors($validator);
        }

        $appointment = new Appointment();
        $patient_name = explode(' - ' ,request('patient_name'));

        $appointment->pat_id = $patient_name[0];
        $appointment->doc_id = request('doctor_id');
        $appointment->date = request('date');
        $appointment->time = request('time');
        $appointment->save();
        //error_log($appointment);
        return redirect('appointments/'.$appointment->doc_id);
    }


    public function update($id,Request $req){
        $appointment = Appointment::where('id', '=', $id)
            ->update([
                'date' => $req->date,
                'time' => $req->time
            ]);
        return redirect('appointments/'.$req->doctor_id);
    }


    public function destroy($id){
        $appDoctor = Appointment::all('id','doc_id')->where('id', '=', $id)->first();
        $appointment = Appointment::where('id', '=', $id)->delete();
        return redirect('appointments/'.$appDoctor->doc_id);
    }
}
