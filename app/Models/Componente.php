<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
	protected $table='componentes';
	protected $fillable=array('id_componente','id_orden','tipo_comp','modelo_comp','serial_comp','cap_comp');
	protected $hidden = ['created_at','updated_at'];
    use HasFactory;

    function orden(){
    	return $this->belongsToMany('App\Orden');
    }
}
