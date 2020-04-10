<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Profile extends FormRequest
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
            "telefono" => "digits_between:7,10",
            "confirmar_contraseña" => "same:nueva_contraseña",
            "foto" => "image|mimes:jpg,jpeg,png|max:3000",
        ];
    }
}
