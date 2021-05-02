<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    public function patient(){
        return $this->hasOne(Patient::class,'id','pat_id');
    }
    public function doctor(){
        return $this->hasOne(Doctor::class,'id','doc_id');
    }
}
