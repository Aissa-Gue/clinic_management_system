<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medication;


class MedicationsController extends Controller
{
    public function showAllData(){
        return view('medications.medications')->with('medication',Medication::all());
    }

    public function search(Request $request){
        $commercial_name = $request->get('com_name');
        $scientific_name = $request->get('sci_name');

        $medication = Medication::where('commercial_name','LIKE','%'.$commercial_name.'%')
            ->where('scientific_name','LIKE','%'.$scientific_name.'%')
            ->paginate(5);
        return view('medications.medications')->with('medication',$medication);
    }

    public function show($id){
        $medication = Medication::findOrFail($id);//same as where 'id' = 1
        return view('medications.preview_medication')->with('medication',$medication);
    }


    public function insertMedication(){
        return view('medications.add_medication');
    }
    public function store(){
        $medication = new Medication();
        $medication->scientific_name = request('scientific_name');
        $medication->commercial_name = request('commercial_name');
        $medication->description = request('description');
        $medication->save();
        //error_log($medication);
        return redirect('medications');
    }


    public function updateMedication($id){
        $medication = Medication::where('id', '=', $id)->firstOrFail();
        return view('medications.update_medication')->with('medication',$medication);
    }
    public function update(Request $req){
        $medication = Medication::where('id', '=', $req->id)
            ->update(['scientific_name' => $req->scientific_name,
                'commercial_name' => $req->commercial_name,
                'description' => $req->description]);
        return redirect('medications');
    }


    public function destroy($id){
        $medication = Medication::where('id', '=', $id)->delete();
        return redirect('medications');
    }
}
