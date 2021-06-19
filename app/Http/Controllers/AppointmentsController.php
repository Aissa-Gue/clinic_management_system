<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Prescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Redirect;
use Validator;
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
            if($doc_id != Auth::id()){
                return redirect('appointments/'.Auth::id());
            }
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

        }else{

            $appointment = new Appointment();
            $patient_name = explode(' - ' ,request('patient_name'));

            $appointment->pat_id = $patient_name[0];
            $appointment->doc_id = request('doctor_id');
            $appointment->date = request('date');
            $appointment->time = request('time');
            $appointment->save();
            //error_log($appointment);
            return Redirect('appointments/'.$appointment->doc_id);
        }
    }

    // Update appointment
    public function getAvailableTimes(Request $req){
        $agenda = DB::table('agendas')
            ->WhereNotExists(function ($query) use ($req){
                $query->select(DB::raw(1))
                    ->from('appointments')
                    ->whereColumn('appointments.time','=','agendas.time')
                    ->where('doc_id','=',$req->doc_id)
                    ->where('date', $req->app_date);
            })
            ->select('agendas.time')
            ->get();

        return view('appointments.edit_appointment')
            ->with('patient_name',$req->patient_name)
            ->with('doc_id',$req->doc_id)
            ->with('app_id',$req->app_id)
            ->with('app_date',$req->app_date)
            ->with('app_time',$req->app_time)
            ->with('agenda',$agenda);
    }

    public function update(Request $req){

        Appointment::where('id', $req->app_id)
            ->update([
                'date' => $req->app_date,
                'time' => $req->app_time
            ]);
        return redirect('appointments/'.$req->doc_id);
    }


    // Delete appointment
    public function destroy($id){
        //Delete prescription & certificate
        $pres_cert= Appointment::join('consultations','appointments.id','=','consultations.app_id')
            ->where('app_id', $id)
            ->select('pres_id','cert_id','doc_id')
            ->first();
        if($pres_cert['pres_id'] != null){
            Prescription::where('id',$pres_cert['pres_id'])->delete();
        }
        if($pres_cert['cert_id'] != null){
            Certificate::where('id',$pres_cert['cert_id'])->delete();
        }

        //Delete appointments
        Appointment::where('id', $id)->delete();

        return redirect('appointments/'.$pres_cert['doc_id']);
    }
}
