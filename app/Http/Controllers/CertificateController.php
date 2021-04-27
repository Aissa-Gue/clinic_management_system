<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\certificate;

class CertificateController extends Controller
{
    public function showAllData(){
        return view('Certifications')->with('Certificate',Certificate::all());
    }
    public function store(){
        $certificate = new Certificate();
        $certificate->from_date = request('from_date');
        $certificate->to_date = request('to_date');
        $certificate->save();
        //error_log($certificate);
        return redirect('Certifications');
    }
    public function update(Request $req){
        $certificate = Certificate::where('id', '=', $req->id)
            ->update(['from_date' => $req->from_date,
                'to_date' => $req->to_date]);
        return redirect('Certifications');
    }


    public function destroy($id){
        $certificate = Certificate::where('id', '=', $id)->delete();
        return redirect('Certifications');
    }
}
