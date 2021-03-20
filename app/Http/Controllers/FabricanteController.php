<?php

namespace App\Http\Controllers;

use App\Models\Fabricante;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FabricanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $messages=[
        'nombre_fab.required'=>'El nombre del fabricante es requerido',
        'nombre_fab.unique'=>'Este nombre ya existe, porfavor intente con otro',
        'telefono_fab.required'=>'El numero es requerido',
        'direccion_fab.required'=>'La dirección es requerida',

    ];

    public function index()
    {
        return Fabricante::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'nombre_fab'=>'required|unique:fabricante',
            'telefono_fab'=>'required',
            'direccion_fab'=>'required',
        ];
        $validator=\Validator::make($request->all(),$rules,$this->messages);
        if ($validator->fails()) {
            return [
                'Created'=>false,
                'errors'=>$validator->errors()->all()
        ];
    }

        $fabricante=Fabricante::create($request->all());
        return \Response::json(['Create'=>true],201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fabricante=Fabricante::find($id);
        if ($fabricante) {
            return \Response::json($fabricante,200);
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
        $fabricante = Fabricante::find($id);
        if ($fabricante) {
            $rules=[
                'nombre_fab'=>['required',Rule::unique('fabricante')->ignore($fabricante->id_fabricante,'id_fabricante')],
                'telefono_fab'=>'required',
                'direccion_fab'=>'required',
            ];

            $validator=\Validator::make($request->all(),$rules,$this->messages);
            if ($validator->fails()) {
                return [
                    'updated'=>false,
                    'errors'=>$validator->errors()->all()
                ];
            }
            $fabricante->update($request->all());
            return \Response::json(['updated'=>true,'data'=>$fabricante],200);
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
         Fabricante::destroy($id);
         return ['deleted' => true];
    }
}
