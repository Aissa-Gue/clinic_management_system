<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Certificate;
use App\Models\Consultation;
use App\Models\Prescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\City;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Auth;

class PatientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAllData(Request $request){
        $first_name = $request->get('fname');
        $last_name = $request->get('lname');

        $patient = Patient::where('first_name','LIKE','%'.$first_name.'%')
            ->where('last_name','LIKE','%'.$last_name.'%')
            ->paginate(90);
        return view('patients.patients')->with('patient',$patient);
    }

    public function show($id){
        $patient = Patient::findOrFail($id);//where 'id' = 1
        return view('patients.preview_patient')->with('patient',$patient);
    }

    public function insertPatient(){
        return view('patients.add_patient')->with('city',City::all());
    }

    public function store(){
        $validator = Validator::make(
            array(
                'first_name' => request('first_name'),
                'last_name' => request('last_name'),
                'birthdate' => request('birthdate'),
                'gender' => request('gender'),
                'city' => request('city'),
                'email' => request('email'),
                'phone' => request('phone')
            ),
            array(
                'first_name' => 'required',
                'last_name' => 'required',
                'birthdate' => 'required|date',
                'gender' => 'required',
                'city' => 'required|numeric',
                'email' => 'required|email|unique:patients',
                'phone' => 'required|numeric|digits:10|unique:patients'
            )
        );
        if ($validator->fails())
        {
            $messages = $validator->messages();
            return $this->insertPatient()->with('messages',$messages);

        }else{
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
    }


    public function updatePatient($id){
        $patient = Patient::where('id', $id)->firstOrFail();
        return view('patients.update_patient')
            ->with('patient',$patient)
            ->with('city',City::all());
    }
    public function update(Request $req, $id){
        $validator = Validator::make(
            array(
                'first_name' => $req->first_name,
                'last_name' =>  $req->last_name,
                'birthdate' =>  $req->birthdate,
                'gender' =>  $req->gender,
                'city' =>  $req->city,
                'email' =>  $req->email,
                'phone' =>  $req->phone
            ),
            array(
                'first_name' => 'required',
                'last_name' => 'required',
                'birthdate' => 'required|date',
                'gender' => 'required',
                'city' => 'required',
                'email' => 'required|email|unique:patients,email,'.$id, //unique email except current patient
                'phone' => 'required|numeric|digits:10|unique:patients,phone,'.$id //unique phone except current patient
            )
        );

        if ($validator->fails()){
            $messages = $validator->messages();

            return $this->updatePatient($id)->with('messages',$messages);
        }else {

            Patient::where('id', $id)->update([
                'first_name' => $req->first_name,
                'last_name' => $req->last_name,
                'birthdate' => $req->birthdate,
                'gender' => $req->gender,
                'address' => $req->address,
                'city_id' => $req->city,
                'email' => $req->email,
                'phone' => $req->phone
                ]);
            return redirect('patients');
        }
    }


    public function destroy($id){
        //Delete all his prescriptions and medical certificates
        $pat_pres_cert = Patient::join('appointments','appointments.pat_id','=','patients.id')
            ->join('consultations','appointments.id','=','consultations.app_id')
            ->where('pat_id',$id)
            ->select('pat_id','pres_id','cert_id')
            ->get();
        foreach ($pat_pres_cert as $data) {
            if ($data->pres_id != null) {
                Prescription::where('id', $data->pres_id)->delete();
            }
            if ($data->cert_id != null) {
                Certificate::where('id', $data->cert_id)->delete();
            }
        }

        //Delete patient
        Patient::where('id', $id)->delete();

        return redirect('patients');
    }
}
