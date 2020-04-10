<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUser extends FormRequest
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
            "cedula" => "required|digits:10|unique:users,cedula",
            "nombre" => "required|string|max:25",
            "apellido_paterno" => "required|string|max:25",
            "apellido_materno" => "required|string|max:25",
            "direccion" => "required|string|max:250",
            "telefono" => "digits_between:7,10",
            "email" => "email|unique:users,email",
            "confirmar_contraseña" => "same:contraseña",
            "foto" => "image|mimes:jpg,jpeg,png|max:3000",
        ];
    }
}
