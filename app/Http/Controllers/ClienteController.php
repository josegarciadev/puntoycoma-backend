<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $messages=[
        'tipo_ced.required'=>'El tipo de cedula es requerido',
        'nro_cedula.required'=>'La cedula es requerida',
        'nro_cedula.unique'=>'Esta cedula ya esta registrada en el sistema',
        'nombre_cliente.required'=>'El nombre es requerido',
        'apellido_cliente.required'=>'El apellido es requerido',
        'direccion.required'=>'La dirección es requerida',
        'telefono.required'=>'El telefono es requerido',
        'status.required'=>'El estatus es requerido',
        'status.in'=>'El status tiene que ser activo o inactivo',
       ];

    public function index()
    {
        return Cliente::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'tipo_ced'=>'required',
            'nro_cedula'=>'required|unique:clientes',
            'nombre_cliente'=>'required',
            'apellido_cliente'=>'required',
            'direccion'=>'required',
            'telefono'=>'required',
            'status'=>'required|in:activo,inactivo'
            ];
            //$\Validator nos permite validar los datos que nos estan llegando por el $request->all(), aparte le masamos las reglas y los mensajes de error.
            $validator = \Validator::make($request->all(), $rules, $this->messages);
                if ($validator->fails()) {
                    return [
                        'created' => false,
                        'errors'  => $validator->errors()->all()
                    ];
                }
        Cliente::create($request->all());
        return ['created' => true];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);
        if($cliente){
            return \Response::json($cliente,200);
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
        $cliente=Cliente::find($id);
        if ($cliente) {
             $rules = [
            'tipo_ced'=>'required',
            'nro_cedula'=>['required',Rule::unique('clientes')->ignore($cliente->id_cliente,'id_cliente')],
            'nombre_cliente'=>'required',
            'apellido_cliente'=>'required',
            'direccion'=>'required',
            'telefono'=>'required',
            'status'=>'required|in:activo,inactivo'
            ];

            $validator=\Validator::make($request->all(),$rules,$this->messages);
            if ($validator->fails()) {

                return [
                    'updated'=>false,
                    'errors'=>$validator->errors()->all()
                ];
            }
            $cliente->update($request->all());
            return \Response::json(['updated' => true,'data'=>$cliente],200);
        }
       return \Response::json([
        'updated' => false,
        'id'=>'no existe'
        ],404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cliente::destroy($id);
         return ['deleted' => true];
    }
}
