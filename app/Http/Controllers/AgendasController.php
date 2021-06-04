<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Agenda;

class AgendasController extends Controller
{
    public function showAllData(){
        return view('planning/planning')->with('agenda',Agenda::all());
    }
    public function store(){
        $validator = Validator::make(
            array(
                'time' => request('time')
            ),
            array(
                'time' => 'required|date_format:H:i'
            )
        );

        if ($validator->fails()) {
            $messages = $validator->messages();
            return view('planning/planning')->with('messages',$messages)
                ->with('agenda',Agenda::all());

        }else{
            $agenda = new Agenda();
            $agenda->time = request('time');
            $agenda->save();
            //error_log($agenda);
            return redirect('planning');
        }
    }

    public function update(Request $req){
        $agenda = Agenda::where('id', '=', $req->id)
            ->update(['time' => $req->time]);
        return redirect('planning');
    }


    public function destroy($id){
        $agenda = Agenda::where('id', '=', $id)->delete();
        return redirect('planning');
    }
}
