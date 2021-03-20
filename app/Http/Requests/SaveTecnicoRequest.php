<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveTecnicoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tipo_ced'=>'required',
            'cedula'=>'required',
            'nombre_tec'=>'required',
            'apellido_tec'=>'required',
            'direccion'=>'required',
            'email'=>'required',
            'telefono'=>'required',
            'status'=>'required'
        ];
    }
    public function messages(){
         return [
        'tipo_ced.required' => 'A tipo is required',
        'cedula.required'  => 'A cedula is required',
        'nombre_tec.required' => 'A nombre is required',
        'apellido_tec.required' => 'A apellido is required',
        'direccion.required'  => 'A direccion is required',
        'email.required' => 'A email is required',
        'telefono.required'  => 'A telefono is required',
        'status.required' => 'A status is required',
    ];
    }
}
