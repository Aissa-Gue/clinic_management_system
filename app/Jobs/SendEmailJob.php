<?php

namespace App\Jobs;

use App\Mail\Gmail;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /*****
         $details = [
            'title' => 'Thank you for your visit',
            'body' => 'REMINDER: You have an appointment today at 8:00 AM'
        ];

        Mail::to('aissastardz@gmail.com')->send(new Gmail($details));
        ******/


        $patients = Patient::join('appointments','patients.id','=','appointments.pat_id')
            ->whereDate('date',Carbon::tomorrow())
            ->select('email','date','time','first_name','last_name')
            ->get();

        foreach($patients as $patient) {
            $title = 'Hi '.$patient->first_name .' ' .$patient->last_name .' !';
            $body = 'You have an appointment tomorrow '.$patient->date .' at ' .Carbon::parse($patient->time)->format('H:i');

            $details = [
                'title' => $title,
                'body' => $body
            ];

            Mail::to($patient->email)->send(new Gmail($details));
        }

    }
}
