<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\Medication;
use App\Models\Prescription;
use App\Models\prescriptions_medications;

class PrescriptionsController extends Controller
{
    public function insert_prescription($app_id){
         $currentPres = Consultation::where('app_id',$app_id)->first('pres_id');
         $pres_medic = prescriptions_medications::where('pres_id',$currentPres->pres_id)->get();
        return view('consultations.prescriptions.add_prescription')
            ->with('currentApp',Appointment::where('id',$app_id)->get())
            ->with('pres_medics',$pres_medic)
            ->with('medications',Medication::all());
    }

    public function store(Request $req , $app_id){
        $currentPres = Consultation::where('app_id',$app_id)->first('pres_id');
        $lastPres = Prescription::max('id');
        $medication = explode(' - ' ,request('medication'));

        if($currentPres->pres_id != null){
            $pres_id = $currentPres->pres_id;
        }else{
            $pres_id = $lastPres + 1;
        }

        Prescription::updateOrCreate([
            'id'   => $pres_id
        ]);

        Consultation::where('app_id',$app_id)
            ->update([
            'pres_id'   => $pres_id
        ]);


        Prescriptions_medications::updateOrCreate([
            'pres_id'   => $pres_id,
            'medic_id'  => $medication[0],
            'quantity'  => $req->input('quantity'),
            'dosage'    => $req->input('dosage')
        ]);
        return redirect('consultations/prescriptions/add/'.$app_id);
    }

    public function destroyMedic($pres_id, $med_id){
        $currentCons = Consultation::where('pres_id',$pres_id)->first('app_id');
        prescriptions_medications::where('pres_id', '=', $pres_id)->where('medic_id',$med_id)->delete();
        return redirect('consultations/prescriptions/add/'.$currentCons->app_id);
    }


}
