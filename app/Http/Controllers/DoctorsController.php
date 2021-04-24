<?php

namespace App\Http\Controllers;

use App\Models\Specialisation;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\City;

class DoctorsController extends Controller
{
    public function showAllData(){
        return view('doctors')->with('doctor',Doctor::all());
    }
    public function show($id){
        $doctor = Doctor::findOrFail($id);//same as where 'id' = 1
        return view('preview_doctor')->with('doctor',$doctor);
    }


    public function insertDoctor(){
        return view('add_doctor')->with('city',City::all())
                                      ->with('speciality',Specialisation::all());
    }
    public function store(){
        $doctor = new Doctor();
        $doctor->last_name = request('last_name');
        $doctor->first_name = request('first_name');
        $doctor->birthdate = request('birthdate');
        $doctor->gender = request('gender');
        $doctor->spec_id = request('speciality');
        $doctor->address = request('address');
        $doctor->city_id = request('city');
        $doctor->email = request('email');
        $doctor->phone = request('phone');
        $doctor->save();
        //error_log($doctor);
        return redirect('doctors');
    }


    public function updateDoctor($id){
        $doctor = Doctor::where('id', '=', $id)->firstOrFail();
        return view('update_doctor')->with('doctor',$doctor)
                                         ->with('city',City::all())
                                         ->with('speciality',Specialisation::all());;
    }
    public function update(Request $req){
        $doctor = Doctor::where('id', '=', $req->id)
            ->update(['first_name' => $req->first_name,
                'last_name' => $req->last_name,
                'birthdate' => $req->birthdate,
                'gender' => $req->gender,
                'spec_id' => $req->speciality,
                'address' => $req->address,
                'city_id' => $req->city,
                'email' => $req->email,
                'phone' => $req->phone]);
        return redirect('doctors');
    }


    public function destroy($id){
        $doctor = Doctor::where('id', '=', $id)->delete();
        return redirect('doctors');
    }
}
