<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Fabricante;
use App\Models\Producto;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $messages=[
        "codigo_producto.required"=>"El codigo del producto es requerido",
        "codigo_producto.unique"=>"El codigo del producto ya esta en uso",
        "nombre_prod.required"=>"El nombre del producto es requerido",
        "descripcion_prod.required"=>"La descripción del producto es requerida",
        "id_categoria.required"=>"La categoria es requerida",
        "id_fabricante.required"=>"El fabricante es requerido",
        "stock.required"=>"El numero de stock es requerido",
        "precio.required"=>"El precio es requerido",
        "foto.required"=>"La foto del producto es requerida",
        "status.required"=>"El estatus es requerido",
        "status.in"=>"El valor del estatus debe ser activo o inactivo"
    ];
    public function index()
    {
        $productos=DB::table('producto')
                    ->join('categoria', 'producto.id_categoria', '=', 'categoria.id_categoria')
                    ->join('fabricante', 'producto.id_fabricante', '=', 'fabricante.id_fabricante')
                    ->select('producto.*', 'categoria.nombre_categoria', 'fabricante.nombre_fab')
                    ->orderBy('id_producto','ASC')
                    ->get();
        return $productos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_categoria=$request->input('id_categoria');
        $categoria=Categoria::find($id_categoria);
        if (!$categoria) {
            return \Response::json(['created'=>false,'errors'=>'Categoria no existente'],422);
        }
        $id_fabricante=$request->input('id_fabricante');
        $fabricante=Fabricante::find($id_fabricante);
         if (!$fabricante) {
            return \Response::json(['created'=>false,'errors'=>'Fabricante no existente'],422);
        }
        $rules=[
                "codigo_producto"=>"required|unique:producto",
                "nombre_prod"=>"required",
                "descripcion_prod"=>"required",
                "id_categoria"=>"required",
                "id_fabricante"=>"required",
                "stock"=>"required",
                "precio"=>"required",
                "foto"=>"required",
                "status"=>"required|in:activo,inactivo"
        ];

        $validator=\Validator::make($request->all(),$rules,$this->messages);
        if ($validator->fails()) {
             return \Response::json(['created'=>false,'errors'=>$validator->errors()->all()],422);
        }
        $producto=Producto::create($request->all());
        return \Response::json(['created'=>true,'data'=>$producto],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto=DB::table('producto')
                    ->join('categoria', 'producto.id_categoria', '=', 'categoria.id_categoria')
                    ->join('fabricante', 'producto.id_fabricante', '=', 'fabricante.id_fabricante')
                    ->select('producto.*', 'categoria.nombre_categoria', 'fabricante.nombre_fab')
                    ->where('id_producto', '=', $id)
                    ->orderBy('id_producto','ASC')
                    ->get();
        /*$producto=Producto::find($id);*/
        if ($producto && !$producto->isEmpty()) {
            return \Response::json($producto,200);
        }
        return \Response::json(['errors'=>true],404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);
        if ($producto) {
            $rules=[
                "codigo_producto"=>['required',Rule::unique('producto')->ignore($producto->id_producto,'id_producto')],
                "nombre_prod"=>"required",
                "descripcion_prod"=>"required",
                "id_categoria"=>"required",
                "id_fabricante"=>"required",
                "stock"=>"required",
                "precio"=>"required",
                "foto"=>"required",
                "status"=>"required|in:activo,inactivo"
        ];

            $validator=\Validator::make($request->all(),$rules,$this->messages);
            if ($validator->fails()) {
                return [
                    'updated'=>false,
                    'errors'=>$validator->errors()->all()
                ];
            }
            $producto->update($request->all());
            return \Response::json(['updated'=>true,'data'=>$producto],200);
        }
        return \Response::json(['updated'=>false],404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Producto::destroy($id);
         return ['deleted' => true];
    }
}
