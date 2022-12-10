<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
	protected $table='detelle_ventas';
        protected $fillable=[
       		  'idventa',
           'idruta',
             'precio'
    ];
      public $timestamps = false;
}
