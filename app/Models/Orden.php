<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
	protected $table='ordenes';
	protected $fillable=array('id_orden','id_cliente','id_tecnico','id_categoria','marca','modelo','observacion','fecha','estado');
	protected $hidden = ['created_at','updated_at'];
    use HasFactory;

    function componente(){
    	return $this->hasMany('App\componente');
    }
    public function cliente()
	{
		return $this->belongsTo('App\Cliente');
	}
	public function categoria()
	{
		return $this->belongsTo('App\Categoria');
	}
	public function tecnico()
	{
		return $this->belongsTo('App\Tecnico');
	}
}
