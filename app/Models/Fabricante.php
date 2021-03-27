<?php

namespace App\Models;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model
{
	protected $table='fabricante';
	protected $primaryKey = 'id_fabricante';
	protected $fillable=array('nombre_fab','telefono_fab','direccion_fab');
	protected $hidden = ['created_at','updated_at'];

    use HasFactory;
	 function productos(){
    	return $this->hasMany(Producto::class);
    }
}
