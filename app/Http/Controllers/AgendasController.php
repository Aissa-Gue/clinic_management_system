<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;

class AgendasController extends Controller
{
    public function showAllData(){
        return view('planning/planning')->with('agenda',Agenda::all());
    }
    public function store(){
        $agenda = new Agenda();
        $agenda->time = request('time');
        $agenda->save();
        //error_log($agenda);
        return redirect('planning');
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
