<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
	protected $table = 'buses';
    protected $fillable=[
		    	'idmarca',
		         'planta',
		         'placa',
		         'capacidad',
		          'codicion'
    ];
    public function marca(){
    	  return $this->belongsTo('App\Marca');
    }
}
