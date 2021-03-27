<?php

namespace App\Models;

use App\Models\Categoria;
use App\Models\Fabricante;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
	protected $table='producto';
	protected $primaryKey = 'id_producto';
	protected $fillable=array('codigo_producto','nombre_prod','descripcion_prod','id_categoria','id_fabricante','foto_prod','stock','precio');
	protected $hidden = ['created_at','updated_at'];
    use HasFactory;

    //Relacion uno a muchos inversa
    public function categoria()
	{
		return $this->belongsTo(Categoria::class);
	}
	public function fabricante()
	{
		return $this->belongsTo(Fabricante::class);
	}

}
