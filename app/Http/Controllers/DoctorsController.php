<?php

namespace App\Http\Controllers;

use App\Models\Specialisation;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\City;
use Validator;


class DoctorsController extends Controller
{
    public function showAllData(){
        return view('doctors.doctors')->with('doctor',Doctor::all());
    }

    public function search(Request $request){
        $first_name = $request->get('fname');
        $last_name = $request->get('lname');

        $doctor = Doctor::where('first_name','LIKE','%'.$first_name.'%')
            ->where('last_name','LIKE','%'.$last_name.'%')
            ->paginate(90);
        return view('doctors.doctors')->with('doctor',$doctor);
    }

    public function show($id){
        $doctor = Doctor::findOrFail($id);//same as where 'id' = 1
        return view('doctors.preview_doctor')->with('doctor',$doctor);
    }


    public function insertDoctor(){
        return view('doctors.add_doctor')->with('city',City::all())
                                      ->with('speciality',specialisation::all('id','speciality'));
    }
    public function store(){
        $validator = Validator::make(
            array(
                'first_name' => request('first_name'),
                'last_name' => request('last_name'),
                'birthdate' => request('birthdate'),
                'spec_id' => request('spec_id'),
                'gender' => request('gender'),
                'city' => request('city'),
                'email' => request('email'),
                'phone' => request('phone')
            ),
            array(
                'first_name' => 'required:doctors',
                'last_name' => 'required:doctors',
                'birthdate' => 'required|date:doctors',
                'spec_id' => 'required:doctors',
                'gender' => 'required:doctors',
                'city' => 'required:doctors',
                'email' => 'required|email|unique:doctors',
                'phone' => 'required|numeric|digits:10|unique:doctors'
            )
        );
        if ($validator->fails())
        {
            $messages = $validator->messages();
            return view('doctors.add_doctor')->with('messages',$messages)
                ->with('city',City::all())
                ->with('speciality',specialisation::all('id','speciality'));
        }

        $doctor = new Doctor();
        $doctor->last_name = request('last_name');
        $doctor->first_name = request('first_name');
        $doctor->birthdate = request('birthdate');
        $doctor->gender = request('gender');
        $doctor->spec_id = request('spec_id');
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
        return view('doctors.update_doctor')->with('doctor',$doctor)
                                         ->with('city',City::all())
                                         ->with('speciality',specialisation::all('id','speciality'));
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
