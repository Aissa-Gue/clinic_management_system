<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\Medication;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAllData(){

        $doctors_revenue = DB::table("users")->where('users.id','>',2)
            ->leftJoin("appointments", function($join){
                $join->on("appointments.doc_id", "=", "users.id")
                    ->whereDate('date',Carbon::today());
            })
            ->leftJoin("consultations", function($join){
                $join->on("consultations.app_id", "=", "appointments.id");
            })
            ->select("users.id", "first_name", "last_name", "speciality", DB::raw('SUM(paid_amount) as paid_amount_sum'))
            ->groupBy("users.id")
            ->get();

        //Using Eloquent
        /*
        $doctors_revenue= User::leftJoin('appointments', 'users.id', '=', 'appointments.doc_id')
            ->leftJoin('consultations', 'appointments.id', '=', 'consultations.app_id')
            ->select('users.id', "first_name", "last_name", "speciality", DB::raw('SUM(paid_amount) as paid_amount_sum'))
            ->whereDate('consultations.created_at',Carbon::today())
            ->groupBy('users.id', "speciality","first_name", "last_name")
            ->get();*/

        $total_patients = Patient::select(DB::raw('COUNT(*) as total_patients'))->whereDate('created_at',Carbon::today())->first();
        $monthly_patients = Patient::select(DB::raw('COUNT(*) as monthly_patients'))
            ->whereMonth('created_at',Carbon::now()->month)
            ->first();

        if(Auth::id() <= 2){ //manager (and Sec)
            $current_appointments = Appointment::select(DB::raw('COUNT(*) as current_appointments'))
                ->whereDate('date',Carbon::today())
                ->first();
            $monthly_appointments = Appointment::select(DB::raw('COUNT(*) as monthly_appointments'))
                ->whereMonth('date',Carbon::now()->month)
                ->first();

            $current_consultations = Consultation::select(DB::raw('COUNT(*) as current_consultations'))
                ->whereDate('created_at',Carbon::today())
                ->first();
            $monthly_consultations = Consultation::select(DB::raw('COUNT(*) as monthly_consultations'))
                ->whereMonth('created_at',Carbon::now()->month)
                ->first();

        }elseif(Auth::id() > 2){ //doctors

            $current_appointments = Appointment::select(DB::raw('COUNT(*) as current_appointments'))
                ->whereDate('date',Carbon::today())
                ->where('doc_id',Auth::id())
                ->first();
            $monthly_appointments = Appointment::select(DB::raw('COUNT(*) as monthly_appointments'))
                ->whereMonth('date',Carbon::now()->month)
                ->where('doc_id',Auth::id())
                ->first();

            $current_consultations = Consultation::leftJoin('appointments','consultations.app_id','=','appointments.id')
                ->select(DB::raw('COUNT(*) as current_consultations'))
                ->whereDate('consultations.created_at',Carbon::today())
                ->where('doc_id',Auth::id())
                ->first();
            $monthly_consultations = Consultation::leftJoin('appointments','consultations.app_id','=','appointments.id')
                ->select(DB::raw('COUNT(*) as monthly_consultations'))
                ->whereMonth('consultations.created_at',Carbon::now()->month)
                ->where('doc_id',Auth::id())
                ->first();
        }


        $current_revenue = Consultation::join('appointments','consultations.app_id','=','appointments.id')
            ->select(DB::raw('SUM(paid_amount) as current_revenue'))
            ->whereDate('date',Carbon::today())
            ->first();
        $monthly_revenue = Consultation::join('appointments','consultations.app_id','=','appointments.id')
            ->select(DB::raw('SUM(paid_amount) as monthly_revenue'))
            ->whereMonth('date',Carbon::now()->month)
            ->first();

        $total_medications = Medication::select(DB::raw('count(*) as total_medic'))
            ->first();

        $doc_appointments = DB::table('appointments')
            ->join('patients','patients.id','=','appointments.pat_id')
            ->WhereNotExists(function ($query){
                $query->select(DB::raw(1))
                    ->from('consultations')
                    ->whereColumn('appointments.id','=','consultations.app_id')
                    ->where('doc_id','=',Auth::id())
                    ->where('date', Carbon::today());
            })
            ->where('doc_id','=',Auth::id())
            ->where('date', Carbon::today())
            ->select('appointments.id', 'first_name', 'last_name','time')
            ->orderBy('time')
            ->get();

        //Charts.js
        $last_revenue_month= Consultation::join('appointments','consultations.app_id','=','appointments.id')
            ->select(DB::raw('SUM(paid_amount) as day_revenue, DAY(date) as day_nbr, DAYNAME(date) as day_name, date'))
                        ->where("date",">", Carbon::now()->subDay(15))
                        ->groupBy("day_nbr")
                        ->orderBy('consultations.created_at')
                        ->get();
        $last_revenue_year= Consultation::select(DB::raw('SUM(paid_amount) as month_revenue, MONTH(created_at) as month_nbr, MONTHNAME(created_at) as month_name'))
            ->whereYear("created_at","=", Carbon::now()->year)
            ->groupBy("month_name")
            ->orderBy('month_nbr')
            ->get();
        $last_appointments= Appointment::select(DB::raw('COUNT(*) as appointments_nbr, MONTH(date) as month_nbr, MONTHNAME(date) as month_name'))
            ->whereYear("date","=", Carbon::now()->year)
            ->groupBy("month_name")
            ->orderBy('month_nbr')
            ->get();
        $last_consultations= Consultation::select(DB::raw('COUNT(*) as consultations_nbr, MONTH(created_at) as month_nbr, MONTHNAME(created_at) as month_name'))
            ->whereYear("created_at","=", Carbon::now()->year)
            ->groupBy("month_name")
            ->orderBy('month_nbr')
            ->get();
        $last_app_cons= Appointment::leftJoin('consultations','appointments.id','=','consultations.app_id')
            ->select(DB::raw('SUM(YEAR(date) = YEAR(CURDATE())) as appointments_nbr, SUM(YEAR(consultations.created_at) = YEAR(CURDATE())) as consultations_nbr, MONTH(date) as month_nbr, MONTHNAME(date) as month_name'))
            ->whereYear("date","=", Carbon::now()->year)
            ->groupBy("month_name")
            ->orderBy('month_nbr')
            ->get();
        $last_patients= Patient::select(DB::raw('COUNT(*) as patients_nbr, MONTH(created_at) as month_nbr, MONTHNAME(created_at) as month_name'))
            ->whereYear("created_at","=", Carbon::now()->year)
            ->groupBy("month_name")
            ->orderBy('month_nbr')
            ->get();
        // End charts queries

        /*** Available appointments
        $available_app = Agenda::leftJoin('appointments','appointments.time','=','agendas.time')
            ->leftJoin('users','users.id','=','appointments.doc_id')
            ->where('users.id','>',2)
            ->groupBy('doc_id')
        ->WhereNotExists(function ($query){
            $query->select(DB::raw(1))
                ->from('appointments')
                ->whereColumn('appointments.time','=','agendas.time')
                ->where('date', Carbon::today());
                //->groupBy('doc_id')
        })
            ->select('doc_id','first_name','last_name','speciality',DB::raw('COUNT(*) as app_nbr'))
            ->get();
**/

        $times_count = Agenda::select(DB::raw('COUNT(*) as times_count'))->first();
        $active_app = User::leftJoin('appointments','users.id','=','appointments.doc_id')
            ->where('users.id','>',2)
            ->select('users.id','first_name','last_name','speciality',DB::raw('SUM(date = CURDATE()) as active_app'))
            ->groupBy('doc_id')
            ->get();

        return view('index')->with('doctors_revenue',$doctors_revenue)
            ->with('total_patients',$total_patients)
            ->with('monthly_patients',$monthly_patients)
            ->with('current_appointments',$current_appointments)
            ->with('monthly_appointments',$monthly_appointments)
            ->with('current_consultations',$current_consultations)
            ->with('monthly_consultations',$monthly_consultations)
            ->with('current_revenue',$current_revenue)
            ->with('monthly_revenue',$monthly_revenue)
            ->with('last_revenue_month',$last_revenue_month)
            ->with('last_revenue_year',$last_revenue_year)
            //->with('last_consultations',$last_consultations)
            //->with('last_appointments',$last_appointments)
            ->with('last_app_cons',$last_app_cons)
            ->with('last_patients',$last_patients)
            ->with('times_count',$times_count)
            ->with('active_app',$active_app)
            ->with('total_medications',$total_medications)
            ->with('doc_appointments',$doc_appointments);



    }


}
