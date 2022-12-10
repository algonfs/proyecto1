<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table ='personas';
   	protected $fillable =[
   		'nombre', 
   		'cedula',
   		'direccion',
   		'telefono',
   		'email'
   	];
   	public function user()
    {
        return $this->hasOne('App\User');
    }
}
