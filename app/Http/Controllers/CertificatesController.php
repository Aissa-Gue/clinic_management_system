<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\certificate;

class CertificatesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($app_id){
        $currentCert = Consultation::where('app_id',$app_id)->first('cert_id');
        $certificate = Certificate::where('id',$currentCert->cert_id)->first();
        // nbr of days
        $from_date = Carbon::parse($certificate['from_date']);
        $to_date = Carbon::parse($certificate['to_date']);
        $days_nbr = $from_date->diffInDays($to_date);

        return view('consultations.certificates.preview_certificate')
            ->with('currentCons',Consultation::where('app_id',$app_id)->get())
            ->with('certificate',$certificate)
            ->with('days_nbr', $days_nbr);
    }
    public function printCert($app_id){
        $currentCert = Consultation::where('app_id',$app_id)->first('cert_id');
        $certificate = Certificate::where('id',$currentCert->cert_id)->first();
        // nbr of days
        $from_date = Carbon::parse($certificate['from_date']);
        $to_date = Carbon::parse($certificate['to_date']);
        $days_nbr = $from_date->diffInDays($to_date);

        return view('consultations.certificates.print_certificate')
            ->with('currentCons',Consultation::where('app_id',$app_id)->get())
            ->with('certificate',$certificate)
            ->with('days_nbr', $days_nbr);
    }

    public function insert_certificate($app_id){

        return view('consultations.certificates.certificate')
            ->with('currentApp',Appointment::where('id',$app_id)->get());
    }

    public function store(Request $req , $app_id){
        $currentCert = Consultation::where('app_id',$app_id)->first('cert_id');
        $lastCert = Certificate::max('id');

        if($currentCert->cert_id != null){
            $cert_id = $currentCert->cert_id;
            Certificate::find($cert_id)->update([
                'id'   => $cert_id,
                'from_date'   => $req->input('from_date'),
                'to_date'  => $req->input('to_date')
            ]);
        }else{
            $cert_id = $lastCert + 1;
            Certificate::Create([
                'id'   => $cert_id,
                'from_date'   => $req->input('from_date'),
                'to_date'  => $req->input('to_date')
            ]);
        }

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
