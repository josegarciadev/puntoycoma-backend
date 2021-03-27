<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Componente;
use App\Models\Orden;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public $messages=[
        "id_cliente.required"=>"El Cliente es requerido",
        "id_tecnico.required"=>"El Tecnico es requerido",
        "id_categoria.required"=>"La Categoria es requerida",
        "marca.required"=>"La marca es requerida",
        "modelo.required"=>"El Modelo es requerido",
        "observacion.required"=>"La observacion",
        "status.required"=>"El estatus es requerido",
        "status.in"=>"El valor del estatus debe ser espera,cancelado o completado",
        "componentes.required"=>"Los componentes de la orden son requeridos"
        ];
        public $rules=[
                "id_cliente"=>"required",
                "id_tecnico"=>"required",
                "id_categoria"=>"required",
                "marca"=>"required",
                "modelo"=>"required",
                "observacion"=>"required",
                "componentes"=>"required",
                "status"=>"required|in:espera,cancelado,completado"
        ];
    public function index()
    {
        $ordenes=DB::table('ordenes')
                    ->join('categoria', 'ordenes.id_categoria', '=', 'categoria.id_categoria')
                    ->join('clientes', 'ordenes.id_cliente', '=', 'clientes.id_cliente')
                    ->join('tecnicos', 'tecnicos.id_tecnico', '=', 'tecnicos.id_tecnico')
                    ->select('ordenes.*', 'categoria.nombre_categoria', 'clientes.*','tecnicos.nombre_tec')
                    ->orderBy('id_orden','DESC')
                    ->get();
        if ($ordenes && !$ordenes->isEmpty()) {
            return \Response::json($ordenes,200);
        }
        return \Response::json(['errors'=>true],404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_cliente=$request->input('id_cliente');
        $cliente=Cliente::find($id_cliente);
        if (!$cliente) {
            return \Response::json(['created'=>false,'errors'=>'Cliente no existente'],422);
        }
        $id_tecnico=$request->input('id_tecnico');
         $tecnico=Cliente::find($id_tecnico);
         if (!$tecnico) {
            return \Response::json(['created'=>false,'errors'=>'Tecnico no existente'],422);
        }
        $id_categoria=$request->input('id_categoria');
         $categoria=Cliente::find($id_categoria);
         if (!$categoria) {
            return \Response::json(['created'=>false,'errors'=>'Categoria no existente'],422);
        }

         $validator=\Validator::make($request->all(),$this->rules,$this->messages);
            if ($validator->fails()) {
                return [
                    'updated'=>false,
                    'errors'=>$validator->errors()->all()
                ];
            }
        $orden= Orden::create($request->all());
        if ($request->componentes) {
            $orden->componentes()->sync($request->componentes);
        }
     return \Response::json(['created'=>true,'data'=>$orden],201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orden=DB::table('ordenes')
                    ->join('categoria', 'ordenes.id_categoria', '=', 'categoria.id_categoria')
                    ->join('clientes', 'ordenes.id_cliente', '=', 'clientes.id_cliente')
                    ->join('tecnicos', 'tecnicos.id_tecnico', '=', 'tecnicos.id_tecnico')
                    ->select('ordenes.*', 'categoria.nombre_categoria', 'clientes.*','tecnicos.nombre_tec')
                    ->orderBy('id_orden','DESC')
                    ->where('id_orden', '=', $id)
                    ->get();
        if ($orden && !$orden->isEmpty()) {
            return \Response::json($orden,200);
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
        $orden= Orden::find($id);
        if ($orden) {
            $validator=\Validator::make($request->all(),$this->rules,$this->messages);
            if ($validator->fails()) {
                return [
                    'updated'=>false,
                    'errors'=>$validator->errors()->all()
                ];
            }
            $orden->update($request->all());
            if ($request->componentes) {
                $orden->componentes()->sync($request->componentes);
            }
            return \Response::json(['updated'=>true,'data'=>$orden],200);
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
        $orden = Orden::find($id);
        if ($orden) {
            $orden->componentes()->detach();
            Orden::destroy($id);
            return ['deleted' => true];
        }
        return ['deleted' => false];
    }
}
