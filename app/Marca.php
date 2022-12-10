<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
   // protected $table ='marcas';
	// protected $primarykey ='id';
	protected $fillable =['marca','condicion'];
	
	public function buses(){
		return $this->hasMany('App\Bus');
	}
}
