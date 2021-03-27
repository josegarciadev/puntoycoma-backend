<?php

namespace App\Models;

use App\Models\Cliente;
use App\Models\Componente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
	protected $table='ordenes';
	protected $primaryKey = 'id_orden';
	protected $fillable=array('id_cliente','id_tecnico','id_categoria','marca','modelo','observacion','status');
	protected $hidden = ['updated_at'];
    use HasFactory;

    public function componentes(){
    	return $this->belongsToMany(Componente::class,'componentes','id_orden','id_orden');
    }
    public function cliente()
	{
		return $this->belongsTo(Cliente::class);
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
