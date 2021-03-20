<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
	protected $table='categoria';
	protected $primaryKey = 'id_categoria';
	protected $fillable=array('nombre_categoria','descripcion_categoria');
	protected $hidden = ['created_at','updated_at'];

    use HasFactory;
    function producto(){
    	return $this->hasMany('App\Producto');
    }

}
