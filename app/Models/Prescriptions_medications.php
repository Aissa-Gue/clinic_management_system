<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prescriptions_medications extends Model
{
    use HasFactory;
    //protected $fillable = ['pres_id','medic_id'];
    protected $guarded = [];

    public function prescription(){
        return $this->belongsTo(Prescription::class);
    }
    public function medication(){
        return $this->hasOne(Medication::class,'id','medic_id');
    }
}
