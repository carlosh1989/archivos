<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCuenta extends FormRequest
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
            'name' => 'required|max:30',
            'email' => 'required|unique:users|max:255',
            'password'=> 'required|min:6|max:30',
            'role'=>'required|alpha',
            'cedula'=>'required|numeric',
            'telefono' => 'required|numeric',
            'comision' => 'required|alpha',
            'direccion' => 'required',
            'parroquia' => 'required',
            'nacimiento' => 'required',
        ];
    }
}
