<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Prescription;
use App\Models\Prescriptions_medications;
use Illuminate\Http\Request;
use App\Models\Medication;
use Illuminate\Support\Facades\DB;
use Validator;

class MedicationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAllData(Request $request){
        $commercial_name = $request->get('com_name');
        $scientific_name = $request->get('sci_name');

        $medication = Medication::where('commercial_name','LIKE','%'.$commercial_name.'%')
            ->where('scientific_name','LIKE','%'.$scientific_name.'%')
            ->paginate(90);

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
        $validator = Validator::make(
            array(
                'scientific_name' => request('scientific_name'),
                'commercial_name' => request('commercial_name')
            ),
            array(
                'scientific_name' => 'required|unique:medications',
                'commercial_name' => 'required|unique:medications'
            )
        );
        if ($validator->fails())
        {
            $messages = $validator->messages();
            return $this->insertMedication()->with('messages',$messages);
        }else{
            $medication = new Medication();
            $medication->scientific_name = request('scientific_name');
            $medication->commercial_name = request('commercial_name');
            $medication->description = request('description');
            $medication->save();
            //error_log($medication);
            return redirect('medications');
        }
    }


    public function updateMedication($id){
        $medication = Medication::where('id', $id)->firstOrFail();
        return view('medications.update_medication')->with('medication',$medication);
    }
    public function update(Request $req, $id){
        $validator = Validator::make(
            array(
                'scientific_name' => request('scientific_name'),
                'commercial_name' => request('commercial_name')
            ),
            array(
                'scientific_name' => 'required|unique:medications,scientific_name,'.$id,
                'commercial_name' => 'required|unique:medications,commercial_name,'.$id,
            )
        );

        if ($validator->fails())
        {
            $messages = $validator->messages();
            return $this->updateMedication($id)->with('messages',$messages);

        }else{
            Medication::where('id', $id)->update([
                'scientific_name' => $req->scientific_name,
                'commercial_name' => $req->commercial_name,
                'description' => $req->description
            ]);
            return redirect('medications');
        }
    }

    public function destroy($id){
        //Test existence of medication in prescription
        $pres_medic_list = Prescriptions_medications::where('medic_id',$id)->get();
        if(!$pres_medic_list->isEmpty() and Request('confirm') != "ok"){
            $notification= "Be Careful ! This medication exist in a prescription if you delete it, it will be deleted from the prescription also !";
            return $this->show($id)->with('notification',$notification);

        }else{ //medication doesn't exist in a prescription

            //Delete medication
            Medication::where('id', $id)->delete();

            // if all medications of prescription deleted (empty prescription) -> delete prescription;
            $pres_medics= Prescription::leftJoin('Prescriptions_medications','prescriptions.id','=','Prescriptions_medications.pres_id')
                ->select('prescriptions.id',DB::raw('SUM(Prescriptions_medications.created_at) as medics_count'))
                ->groupBy('prescriptions.id')
                ->get();

            foreach ($pres_medics as $data){
                if($data->medics_count == null){
                    //Set consultation pres_id to null
                    Consultation::where('pres_id',$data->pres_id)->update([
                        'pres_id' => null
                    ]);

                    // Delete prescription
                    Prescription::where('id',$data->id)->delete();
                }
            }

            return redirect('medications');
        }
    }


}
