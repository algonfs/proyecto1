<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    protected $table = 'viajes';
    protected $fillable =[
        'idconductor', 
        'idbus',
        'idruta',
        'descripcion',
        'condicion'
    ];

     public function conductor(){
        return $this->belongsTo('App\Conductor');
    }

    public function bus(){
        return $this->belongsTo('App\Bus');
    }
     public function ruta(){
        return $this->belongsTo('App\Ruta');
    }
}
