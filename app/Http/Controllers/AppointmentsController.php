<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

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
            ->with('appointment',Appointment::all()->where('doc_id','=',$doc_id))
            ->with('patient',Patient::all('id','first_name','last_name'))
            ->with('doctor',Doctor::all('id','first_name','last_name'))
            ->with('currentDocId',Doctor::all('id')->where('id',$doc_id)->first())
            ->with('agenda',$agenda)
            ->with('speciality',Specialisation::all());
    }


    public function show($id){
        $appointment = Appointment::findOrFail($id);//same as where 'id' = 1
        return view('appointments.preview_appointment')
            ->with('appointment',$appointment)
            ->with('patient',Patient::all())
            ->with('doctor',Doctor::all())
            ->with('agenda',Agenda::all());
    }


    public function insertAppointment(){
        return view('appointments.add_appointment')
            ->with('patient',Patient::all())
            ->with('doctor',Doctor::all())
            ->with('agenda',Agenda::all());
    }
    public function store(){
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

    public function updateAppointment($id){
        $appointment = Appointment::where('id', '=', $id)->firstOrFail();
        return view('appointments.update_appointment')
            ->with('appointment',$appointment)
            ->with('patient',Patient::all())
            ->with('doctor',Doctor::all())
            ->with('agenda',Agenda::all());
    }
    public function update(Request $req){
        $appointment = Appointment::where('id', '=', $req->id)
            ->update(['pat_id' => $req->patient_name,
                'doc_id' => $req->doctor_name,
                'date' => $req->date,
                'time' => $req->time]);
        return redirect('appointments');
    }


    public function destroy($id){
        $doctor = Appointment::where('id', '=', $id)->delete();
        return redirect('appointments');
    }
}
