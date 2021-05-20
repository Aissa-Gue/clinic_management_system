<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\certificate;

class CertificatesController extends Controller
{
    public function insert_certificate($app_id){
        $currentCert = Consultation::where('app_id',$app_id)->first('cert_id');
        $certificate = Certificate::where('id',$currentCert->cert_id)->get();

        return view('consultations.certificates.certificate')
            ->with('currentApp',Appointment::where('id',$app_id)->get())
            ->with('Certificate',$certificate);
    }


    public function store(Request $req , $app_id){
        $currentCert = Consultation::where('app_id',$app_id)->first('cert_id');
        $lastCert = Certificate::max('id');

        if($currentCert->cert_id != null){
            $cert_id = $currentCert->cert_id;
        }else{
            $cert_id = $lastCert + 1;
        }

        Certificate::updateOrCreate([
            'id'   => $cert_id,
            'from_date'   => $req->input('from_date'),
            'to_date'  => $req->input('to_date')
        ]);

        Consultation::where('app_id',$app_id)
            ->update([
                'cert_id'   => $cert_id
            ]);

        return redirect('consultations/certificates/'.$app_id);
    }

    public function destroy($id){
        $certificate = Certificate::where('id', '=', $id)->delete();
        return redirect('Certifications');
    }
}
