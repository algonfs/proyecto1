<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   // protected $table = 'users';
    protected $fillable = [
        'id', 'usuario', 'password','condicion','idrol'
    ];
    public $timestamps = false;
   
    protected $hidden = [
        'password', 'remember_token',
    ];

   
     public function rol(){
        return $this->belongsTo('App\Rol');
    }

    public function persona(){
        return $this->belongsTo('App\Persona');
    }

}
