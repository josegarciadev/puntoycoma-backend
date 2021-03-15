<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
	protected $table='producto';
	protected $fillable=array('id_producto','codigo_producto','nombre_prod','descripcion_prod','id_categoria','id_fabricante','foto_prod','stock','precio');
	protected $hidden = ['created_at','updated_at'];
    use HasFactory;

    public function fabricante()
	{
		// 1 avión pertenece a un Fabricante.
		// $this hace referencia al objeto que tengamos en ese momento de Avión.
		return $this->belongsTo('App\Fabricante');
	}
	public function categoria()
	{
		// 1 avión pertenece a un Fabricante.
		// $this hace referencia al objeto que tengamos en ese momento de Avión.
		return $this->belongsTo('App\Categoria');
	}
}
