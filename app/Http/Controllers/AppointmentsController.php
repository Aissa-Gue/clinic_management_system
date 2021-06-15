<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Redirect;
use Carbon\Carbon;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Patient;
use App\Models\Agenda;


class AppointmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAllData(){
        return view('appointments.appointments')
            ->with('appointment',Appointment::all())
            ->with('patient',Patient::all())
            ->with('doctor',User::where('id','>',2))
            ->with('agenda',Agenda::all());
    }


    public function showSpeciality($doc_id, Request $req){
        $agenda = DB::table('agendas')
            ->WhereNotExists(function ($query) use ($doc_id, $req){
                $query->select(DB::raw(1))
                    ->from('appointments')
                    ->whereColumn('appointments.time','=','agendas.time')
                    ->where('doc_id','=',$doc_id)
                    ->where('date', $req->app_date);
            })
            ->select('agendas.time')
            ->get();

        if(Auth::id() <= 2){
            return view('appointments.appointments')
                ->with('appointment',Appointment::where('doc_id',$doc_id)->whereDate('date',Carbon::today())->orderByDesc('time')->orderByDesc('date')->get())
                ->with('patient',Patient::all('id','first_name','last_name'))
                ->with('doctor',User::where('id','>',2)->get())
                ->with('currentDoc',User::where('id',$doc_id)->first())
                ->with('agenda',$agenda);
        }else{
            return view('appointments.appointments')
                ->with('appointment',Appointment::where('doc_id',$doc_id)->whereDate('date',Carbon::today())->orderByDesc('time')->orderByDesc('date')->get())
                ->with('patient',Patient::all('id','first_name','last_name'))
                ->with('doctor',User::where('id',Auth::id())->get())
                ->with('currentDoc',User::where('id',$doc_id)->first())
                ->with('agenda',$agenda);
        }
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
                'patient_id' => 'required|numeric',
                'doctor_id' => 'required|numeric',
                'date' => 'required|date',
                'time' => 'required|date_format:H:i:s'
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
