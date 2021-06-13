<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\Medication;
use App\Models\Prescription;
use App\Models\prescriptions_medications;

class PrescriptionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($app_id){
        $currentPres = Consultation::where('app_id',$app_id)->first('pres_id');
        $pres_medic = prescriptions_medications::where('pres_id',$currentPres->pres_id)->get();
        return view('consultations.prescriptions.preview_prescription')
            ->with('currentCons',Consultation::where('app_id',$app_id)->get())
            ->with('pres_medics',$pres_medic);
    }
    public function printPres($app_id){
        $currentPres = Consultation::where('app_id',$app_id)->first('pres_id');
        $pres_medic = prescriptions_medications::where('pres_id',$currentPres->pres_id)->get();
        return view('consultations.prescriptions.print_prescription')
            ->with('currentCons',Consultation::where('app_id',$app_id)->get())
            ->with('pres_medics',$pres_medic)
            ->with('prescription', $currentPres);
    }

    public function insert_prescription($app_id){
         $currentPres = Consultation::where('app_id',$app_id)->first('pres_id');
         $pres_medic = prescriptions_medications::where('pres_id',$currentPres->pres_id)->get();
        return view('consultations.prescriptions.prescription')
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

        $validator = Validator::make(
            array(
                'pres_id' => $pres_id,
                'medic_id' => $medication[0],
                'quantity' => $req->input('quantity'),
                'dosage' => $req->input('dosage')
            ),
            array(
                'pres_id' => 'required|numeric',
                'medic_id' => 'required|numeric',
                'quantity' => 'required|numeric',
                'dosage' => 'required'
            )
        );

        if ($validator->fails()){
            $messages = $validator->messages();

            $currentPres = Consultation::where('app_id',$app_id)->first('pres_id');
            $pres_medic = prescriptions_medications::where('pres_id',$currentPres->pres_id)->get();
            return view('consultations.prescriptions.prescription')->with('messages',$messages)
                ->with('currentApp',Appointment::where('id',$app_id)->get())
                ->with('pres_medics',$pres_medic)
                ->with('medications',Medication::all());
        }else {

            Prescription::updateOrCreate([
                'id' => $pres_id
            ]);

            Consultation::where('app_id', $app_id)
                ->update([
                    'pres_id' => $pres_id
                ]);

            Prescriptions_medications::updateOrCreate([
                'pres_id' => $pres_id,
                'medic_id' => $medication[0],
                'quantity' => $req->input('quantity'),
                'dosage' => $req->input('dosage')
            ]);
            return redirect('consultations/prescriptions/' . $app_id);
        }
    }

    public function destroyMedic($pres_id, $med_id){
        $currentCons = Consultation::where('pres_id',$pres_id)->first('app_id');
        Prescriptions_medications::where('pres_id', '=', $pres_id)->where('medic_id',$med_id)->delete();

        return redirect('consultations/prescriptions/'.$currentCons->app_id);
    }

    public function destroy($pres_id){
        $currentCons = Consultation::where('pres_id',$pres_id)->first('app_id');
        Prescription::where('id', '=', $pres_id)->delete();
        // set consultation prescription to null
        // verify if all medications deleted delete prescription;
        return redirect('consultations/prescriptions/'.$currentCons->app_id);
    }

}
