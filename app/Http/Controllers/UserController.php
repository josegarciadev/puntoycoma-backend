<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $messages=[
        'nombres.required'=>'Los nombres son requeridos',
        'email.required'=>'El email es requerido',
        'email.unique'=>'Esta email ya esta registrado en el sistema',
        'password.required'=>'La contraseña es requerida',
        'password.min'=>'La contraseña debe tener minimo 6 caracteres',
        'status.required'=>'El estatus es requerido',
        'status.in'=>'El status tiene que ser activo o inactivo',
       ];
    public function index()
    {
        return User::get();
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
            'nombres'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required|min:6',
            'status'=>'required|in:activo,inactivo'
        ];
        $validator=\Validator::make($request->all(),$rules,$this->messages);
        if ($validator->fails()) {
            return [
                'created'=>false,
                'errors'=>$validator->errors()->all()
            ];
        }
        User::create($request->all());
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
       $user = User::find($id);
        if($user){
            return \Response::json($user,200);
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
        $user=User::find($id);
        if ($user) {
             $rules = [
            'nombres'=>'required',
            'email'=>['required',Rule::unique('users')->ignore($user->id_user,'id_user')],
            'password'=>'required|min:6',
            'status'=>'required|in:activo,inactivo'
            ];

            $validator=\Validator::make($request->all(),$rules,$this->messages);
            if ($validator->fails()) {

                return [
                    'updated'=>false,
                    'errors'=>$validator->errors()->all()
                ];
            }
            $user->update($request->all());
            return \Response::json(['updated' => true,'data'=>$user],200);
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
       User::destroy($id);
         return ['deleted' => true];
    }
}
