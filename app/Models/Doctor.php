<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    public function city(){
        return $this->hasOne(City::class,'id','city_id');
    }
    public function speciality(){
        return $this->hasOne(Specialisation::class,'id','spec_id');
    }
}
