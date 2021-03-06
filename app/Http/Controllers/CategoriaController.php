<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $messages=[
        'nombre_categoria.required'=>'El nombre del categoria es requerido',
        'nombre_categoria.unique'=>'Este nombre ya existe, porfavor intente con otro',
        'descripcion_categoria.required'=>'El numero es requerido',
    ];
    public function index()
    {
        return Categoria::get();
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
            'nombre_categoria'=>'required|unique:categoria',
            'descripcion_categoria'=>'required',
        ];
        $validator=\Validator::make($request->all(),$rules,$this->messages);
        if ($validator->fails()) {
            return [
                'Created'=>false,
                'errors'=>$validator->errors()->all()
            ];
        }

        $categoria=Categoria::create($request->all());
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
         $categoria=Categoria::find($id);
        if ($categoria) {
            return \Response::json($categoria,200);
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
        $categoria = Categoria::find($id);
        if ($categoria) {
            $rules=[
                'nombre_categoria'=>['required',Rule::unique('categoria')->ignore($categoria->id_categoria,'id_categoria')],
                'descripcion_categoria'=>'required',
            ];

            $validator=\Validator::make($request->all(),$rules,$this->messages);
            if ($validator->fails()) {
                return [
                    'updated'=>false,
                    'errors'=>$validator->errors()->all()
                ];
            }
            $categoria->update($request->all());
            return \Response::json(['updated'=>true,'data'=>$categoria],200);
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
        //
    }
}
