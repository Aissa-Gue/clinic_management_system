<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\City;

class DoctorsController extends Controller
{
    public function showAllData(){
        return view('doctors.doctors')->with('doctor',Doctor::all());
    }
    public function show($id){
        $doctor = Doctor::findOrFail($id);//same as where 'id' = 1
        return view('doctors.preview_doctor')->with('doctor',$doctor);
    }


    public function insertDoctor(){
        $speciality = array('skin','Orthopedic','general','dentist');
        return view('doctors.add_doctor')->with('city',City::all())
                                      ->with('speciality',$speciality);
    }
    public function store(){
        $doctor = new Doctor();
        $doctor->last_name = request('last_name');
        $doctor->first_name = request('first_name');
        $doctor->birthdate = request('birthdate');
        $doctor->gender = request('gender');
        $doctor->speciality = request('speciality');
        $doctor->address = request('address');
        $doctor->city_id = request('city');
        $doctor->email = request('email');
        $doctor->phone = request('phone');
        $doctor->save();
        //error_log($doctor);
        return redirect('doctors');
    }

    public function updateDoctor($id){
        $speciality = array('skin','Orthopedic','general','dentist');
        $doctor = Doctor::where('id', '=', $id)->firstOrFail();
        return view('doctors.update_doctor')->with('doctor',$doctor)
                                         ->with('city',City::all())
                                         ->with('speciality',$speciality);
    }
    public function update(Request $req){
        $doctor = Doctor::where('id', '=', $req->id)
            ->update(['first_name' => $req->first_name,
                'last_name' => $req->last_name,
                'birthdate' => $req->birthdate,
                'gender' => $req->gender,
                'speciality' => $req->speciality,
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
