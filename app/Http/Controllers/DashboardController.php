<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAllData(){
        //using query Builder

            $doctors_revenue = DB::table("consultations")
            ->leftJoin("appointments", function($join){
                $join->on("appointments.id", "=", "consultations.app_id");
            })
            ->leftJoin("users", function($join){
                $join->on("users.id", "=", "appointments.doc_id");
            })
            ->select("users.id", "first_name", "last_name", "speciality", DB::raw('SUM(paid_amount) as paid_amount_sum'))
            ->groupBy("users.id", "speciality","first_name", "last_name")
            ->get();

        $doctors_revenue = DB::table("users")->where('users.id','>',2)
            ->leftJoin("appointments", function($join){
                $join->on("appointments.doc_id", "=", "users.id");
            })
            ->leftJoin("consultations", function($join){
                $join->on("consultations.app_id", "=", "appointments.id")
                    ->whereDate('consultations.created_at',Carbon::today());
            })
            ->select("users.id", "first_name", "last_name", "speciality", DB::raw('SUM(paid_amount) as paid_amount_sum'))
            ->groupBy("users.id", "speciality","first_name", "last_name")
            ->get();

        //Using Eloquent
        /*
        $doctors_revenue= User::leftJoin('appointments', 'users.id', '=', 'appointments.doc_id')
            ->leftJoin('consultations', 'appointments.id', '=', 'consultations.app_id')
            ->select('users.id', "first_name", "last_name", "speciality", DB::raw('SUM(paid_amount) as paid_amount_sum'))
            ->whereDate('consultations.created_at',Carbon::today())
            ->groupBy('users.id', "speciality","first_name", "last_name")
            ->get();*/

        $total_patients = Patient::select(DB::raw('COUNT(*) as total_patients'))->first();
        $monthly_patients = Patient::select(DB::raw('COUNT(*) as monthly_patients'))
            ->whereMonth('created_at',Carbon::now()->month)
            ->first();

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

        $current_revenue = Consultation::select(DB::raw('SUM(paid_amount) as current_revenue'))
            ->whereDate('created_at',Carbon::today())
            ->first();
        $monthly_revenue = Consultation::select(DB::raw('SUM(paid_amount) as monthly_revenue'))
            ->whereMonth('created_at',Carbon::now()->month)
            ->first();

        //Charts.js
        $last_revenue_month= Consultation::select(DB::raw('SUM(paid_amount) as day_revenue, DAY(created_at) as day_nbr, DAYNAME(created_at) as day_name, created_at'))
                        ->where("created_at",">", Carbon::now()->subDay(30))
                        ->groupBy("day_name","day_nbr","created_at")
                        ->orderBy('created_at')
                        ->get();
        $last_revenue_year= Consultation::select(DB::raw('SUM(paid_amount) as month_revenue, MONTH(created_at) as month_nbr, MONTHNAME(created_at) as month_name'))
            ->whereYear("created_at","=", Carbon::now()->year)
            ->groupBy("month_name","month_nbr")
            ->orderBy('month_nbr')
            ->get();
        $last_appointments= Appointment::select(DB::raw('COUNT(*) as appointments_nbr, MONTH(created_at) as month_nbr, MONTHNAME(created_at) as month_name'))
            ->whereYear("created_at","=", Carbon::now()->year)
            ->groupBy("month_name","month_nbr")
            ->orderBy('month_nbr')
            ->get();
        $last_consultations= Consultation::select(DB::raw('COUNT(*) as consultations_nbr, MONTH(created_at) as month_nbr, MONTHNAME(created_at) as month_name'))
            ->whereYear("created_at","=", Carbon::now()->year)
            ->groupBy("month_name","month_nbr")
            ->orderBy('month_nbr')
            ->get();
        $last_patients= Patient::select(DB::raw('COUNT(*) as patients_nbr, MONTH(created_at) as month_nbr, MONTHNAME(created_at) as month_name'))
            ->whereYear("created_at","=", Carbon::now()->year)
            ->groupBy("month_name","month_nbr")
            ->orderBy('month_nbr')
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
            ->with('last_consultations',$last_consultations)
            ->with('last_appointments',$last_appointments)
            ->with('last_patients',$last_patients);


    }


}
