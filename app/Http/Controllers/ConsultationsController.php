<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Carbon\Carbon;

use App\Models\Doctor;
use App\Models\Patient;
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
}
