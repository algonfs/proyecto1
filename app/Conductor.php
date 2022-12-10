<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
	protected $table ='conductores';
   	protected $fillable =[
   		'nombre', 
   		'cedula',
   		'brevete',
   		'direccion',
   		'telefono', 
   		'condicion'
   	];

}
