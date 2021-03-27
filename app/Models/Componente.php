<?php

namespace App\Models;

use App\Models\Orden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
	protected $table='componentes';
	protected $primaryKey = 'id_componente';
	protected $fillable=array('tipo_comp','modelo_comp','serial_comp','cap_comp','created_at','updated_at');
	protected $hidden = ['created_at','updated_at'];
    use HasFactory;

    public function orden(){
    	return $this->belongsToMany(Orden::class,'componentes','id_orden','tipo_comp','modelo_comp','serial_comp','cap_comp');
    }
}
