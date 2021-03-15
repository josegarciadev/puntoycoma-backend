<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
	protected $table='tecnicos';
	protected $fillable=array('id_tecnico','tipo_ced','cedula','nombre_tec','apellido_tec','direccion','email','telefono','status');
	protected $hidden = ['created_at','updated_at'];
    use HasFactory;
    public function orden()
	{
		// 1 avión pertenece a un Fabricante.
		// $this hace referencia al objeto que tengamos en ese momento de Avión.
		return $this->belongsTo('App\orden');
	}
}
