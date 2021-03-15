<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
	protected $table='clientes';
	protected $fillable=array('id_cliente','tipo_ced','nro_cedula','nombre_cliente','apellido_cliente','direccion','telefono','status');
    protected $hidden = ['created_at','updated_at'];
    use HasFactory;
	public function orden()
	{
		return $this->hasMany('App\Orden');
	}

}
