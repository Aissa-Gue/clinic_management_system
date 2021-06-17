<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\City;
use Validator;


class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAllData(Request $request){
        $first_name = $request->get('fname');
        $last_name = $request->get('lname');

        $doctor = User::where('id','>',2)
            ->where('first_name','LIKE','%'.$first_name.'%')
            ->where('last_name','LIKE','%'.$last_name.'%')
            ->paginate(90);
        return view('doctors.doctors')->with('doctor', $doctor);
    }

    public function show($id){
        $doctor = User::findOrFail($id);//same as where 'id' = 1
        return view('doctors.preview_doctor')->with('doctor',$doctor);
    }


    public function insertDoctor(){
        return view('doctors.add_doctor')->with('city',City::all());
    }
    public function store(){
        $validator = Validator::make(
            array(
                'first_name' => request('first_name'),
                'last_name' => request('last_name'),
                'birthdate' => request('birthdate'),
                'speciality' => request('speciality'),
                'gender' => request('gender'),
                'city' => request('city'),
                'email' => request('email'),
                'phone' => request('phone')
            ),
            array(
                'first_name' => 'required',
                'last_name' => 'required',
                'birthdate' => 'required|date',
                'speciality' => 'required',
                'gender' => 'required',
                'city' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required|numeric|digits:10|unique:users'
            )
        );
        if ($validator->fails())
        {
            $messages = $validator->messages();
            return $this->insertDoctor()->with('messages',$messages);
        }

        $doctor = new User();
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
        $doctor = User::where('id', $id)->firstOrFail();
        return view('doctors.update_doctor')->with('doctor',$doctor)
                                         ->with('city',City::all());
    }
    public function update(Request $req, $id){

        $validator = Validator::make(
            array(
                'first_name' => $req->first_name,
                'last_name' =>  $req->last_name,
                'birthdate' =>  $req->birthdate,
                'speciality' =>  $req->speciality,
                'gender' =>  $req->gender,
                'city' =>  $req->city,
                'email' =>  $req->email,
                'phone' =>  $req->phone
            ),
            array(
                'first_name' => 'required',
                'last_name' => 'required',
                'birthdate' => 'required|date',
                'speciality' => 'required',
                'gender' => 'required',
                'city' => 'required',
                'email' => 'required|email|unique:users,email,'.$id,
                'phone' => 'required|numeric|digits:10|unique:users,phone,'.$id
            )
        );

        if ($validator->fails()){
            $messages = $validator->messages();
            return $this->updateDoctor($id)->with('messages',$messages);

        }else{

            User::where('id', $id)->update([
                'first_name' => $req->first_name,
                'last_name' => $req->last_name,
                'birthdate' => $req->birthdate,
                'gender' => $req->gender,
                'speciality' => $req->speciality,
                'address' => $req->address,
                'city_id' => $req->city,
                'email' => $req->email,
                'phone' => $req->phone
            ]);
            return redirect('doctors');
        }
    }


    public function destroy($id){
        //Delete all the prescriptions and medical certificates of his patients
        $doc_pres_cert = User::join('appointments','appointments.doc_id','=','users.id')
            ->join('consultations','appointments.id','=','consultations.app_id')
            ->where('doc_id',$id)
            ->select('doc_id','pres_id','cert_id')
            ->get();
        foreach ($doc_pres_cert as $data){
            if($data->pres_id != null){
                Prescription::where('id',$data->pres_id)->delete();
            }
            if($data->cert_id != null){
                Certificate::where('id',$data->cert_id)->delete();
            }
        }

        //Delete doctor
        User::where('id', $id)->delete();
        return redirect('doctors');
    }
}
