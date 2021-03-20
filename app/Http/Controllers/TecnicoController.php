<?php

namespace App\Http\Controllers;


use App\Http\Requests\SaveTecnicoRequest;
use App\Models\Tecnico;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
class TecnicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $messages=[
        'tipo_ced.required'=>'El tipo de cedula es requerido',
        'cedula.required'=>'La cedula es requerida',
        'nombre_tec.required'=>'El nombre es requerido',
        'apellido_tec.required'=>'El apellido es requerido',
        'direccion.required'=>'La dirección es requerida',
        'email.required'=>'El email es requerido',
        'telefono.required'=>'El telefono es requerido',
        'status.required'=>'El estatus es requerido',
        'status.in'=>'El status tiene que ser activo o inactivo',
        'cedula.unique'=>'Esta cedula ya esta registrada en el sistema',
        'email.unique'=>'Este email ya esta ocupado'
       ];
    function __construct()
    {

    }
    public function index()
    {
        $resp =Tecnico::get();
        return $resp;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Reglas para la validacion en la creacion de nuevos tencicos
         $rules = [
            'tipo_ced'=>'required',
            'cedula'=>'required|unique:tecnicos',
            'nombre_tec'=>'required',
            'apellido_tec'=>'required',
            'direccion'=>'required',
            'email'=>'required|unique:tecnicos',
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
        Tecnico::create($request->all());
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
        $tecnico = Tecnico::find($id);
        if($tecnico){
            return \Response::json($tecnico,200);
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

        $tecnico=Tecnico::find($id);
        if ($tecnico) {
             $rules = [
            'tipo_ced'=>'required',
            'cedula'=>['required',Rule::unique('tecnicos')->ignore($tecnico->id_tecnico,'id_tecnico')],
            'nombre_tec'=>'required',
            'apellido_tec'=>'required',
            'direccion'=>'required',
            'email'=>['required','email',Rule::unique('tecnicos')->ignore($tecnico->id_tecnico,'id_tecnico')],
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
            $tecnico->update($request->all());
            return \Response::json(['updated' => true,'data'=>$tecnico],200);
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
         Tecnico::destroy($id);
         return ['deleted' => true];

    }
}