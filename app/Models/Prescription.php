<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $fillable = ['id'];

    public function pres_medic(){
        return $this->hasMany(prescriptions_medications::class);
    }

}
