<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'user';

    //protected $guarded = [];

    protected $fillable = [
        'first_name','last_name','birthdate','gender', 'address',
        'city_id','speciality','email','phone', 'password',
    ];
    protected $hidden = [
        'password',
    ];

    public function city(){
        return $this->hasOne(City::class,'id','city_id');
    }


}
