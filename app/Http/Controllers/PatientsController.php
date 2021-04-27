<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\City;

class PatientsController extends Controller
{
    public function showAllData(){
        return view('patients.patients')->with('patient',Patient::all());
    }
    public function show($id){
        //$patient = Patient::where('id', '=', $id)->firstOrFail();//same as where 'id' = 1
        $patient = Patient::findOrFail($id);//same as where 'id' = 1
        return view('patients.preview_patient')->with('patient',$patient);
    }


    public function insertPatient(){
        return view('patients.add_patient')->with('city',City::all());
    }
    public function store(){
        $patient = new Patient();
        $patient->last_name = request('last_name');
        $patient->first_name = request('first_name');
        $patient->birthdate = request('birthdate');
        $patient->gender = request('gender');
        $patient->address = request('address');
        $patient->city_id = request('city');
        $patient->email = request('email');
        $patient->phone = request('phone');
        $patient->save();
        //error_log($patient);
        return redirect('patients');
    }


    public function updatePatient($id){
        $patient = Patient::where('id', '=', $id)->firstOrFail();
        return view('patients.update_patient')->with('patient',$patient)
                                          ->with('city',City::all());
    }
    public function update(Request $req){
        $patient = Patient::where('id', '=', $req->id)
            ->update(['first_name' => $req->first_name,
                'last_name' => $req->last_name,
                'birthdate' => $req->birthdate,
                'gender' => $req->gender,
                'address' => $req->address,
                'city_id' => $req->city,
                'email' => $req->email,
                'phone' => $req->phone]);
        return redirect('patients');
    }


    public function destroy($id){
        $patient = Patient::where('id', '=', $id)->delete();
        return redirect('patients');
    }
}
