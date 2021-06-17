<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Agenda;

class AgendasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
            return $this->showAllData()->with('messages',$messages);

        }else{
            $agenda = new Agenda();
            $agenda->time = request('time');
            $agenda->save();
            //error_log($agenda);
            return redirect('planning');
        }
    }

    public function update(Request $req, $id){
        $validator = Validator::make(
            array(
                'time' => $req->time
            ),
            array(
                'time' => 'required|date_format:H:i'
            )
        );
        $agenda = Agenda::where('id', $id);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return $this->showAllData()->with('messages',$messages);

        }else {
            $agenda->update(['time' => $req->time]);
            return redirect('planning');
        }
    }


    public function destroy($id){
        Agenda::where('id', '=', $id)->delete();
        return redirect('planning');
    }
}
