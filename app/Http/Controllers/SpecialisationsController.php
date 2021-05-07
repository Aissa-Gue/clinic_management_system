<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

use App\Models\Specialisation;

class SpecialisationsController extends Controller
{
    public function showAllData(){
        return view('specialisations.specialisations')
            ->with('specialisation',Specialisation::all())
            ->with('doctor',Doctor::all('id','first_name','last_name'));
    }


    public function search(Request $request){
        $speciality = $request->get('speciality');
        $description = $request->get('description');

        $specialisation = Specialisation::where('speciality','LIKE','%'.$speciality.'%')
            ->where('description','LIKE','%'.$description.'%')
            ->paginate(90);
        return view('specialisations.specialisations')->with('specialisation',$specialisation);
    }

    public function store(){
        $specialisation = new Specialisation();
        $specialisation->speciality = request('speciality');
        $specialisation->description = request('description');
        $specialisation->save();
        //error_log($specialisation);
        return redirect('specialisations');
    }

    public function update(Request $req){
        $specialisation = Specialisation::where('id', '=', $req->id)
            ->update(['speciality' => $req->speciality,
                'description' => $req->description]);
        return redirect('specialisations');
    }

    public function destroy($id){
        $medication = Specialisation::where('id', '=', $id)->delete();
        return redirect('specialisations');
    }
}
