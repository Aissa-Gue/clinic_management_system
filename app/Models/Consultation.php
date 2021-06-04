<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;
    protected $fillable = ['pres_id'];

    public function appointment(){
        return $this->hasOne(Appointment::class,'id','app_id');
    }
    public function prescription(){
        return $this->hasOne(Prescription::class,'id','pres_id');
    }
    public function certificate(){
        return $this->hasOne(Certificate::class,'id','cert_id');
    }
}
