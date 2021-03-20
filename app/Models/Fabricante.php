<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model
{
	protected $table='fabricante';
	protected $primaryKey = 'id_fabricante';
	protected $fillable=array('nombre_fab','telefono_fab','direccion_fab');
	protected $hidden = ['created_at','updated_at'];

    use HasFactory;
    public function producto()
	{
		// 1 avión pertenece a un Fabricante.
		// $this hace referencia al objeto que tengamos en ese momento de Avión.
		return $this->hasMany('App\Producto');
	}
}
