<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditVehiculo extends FormRequest
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
            "color" => "string|max:50",
            "kilometraje" => "digits_between:0,7",
            "tipo" => "string|max:50",
            "observacion_vehiculo" => "string|max:500",
            "cedula" => "required|digits:10|exists:clientes,cedula",
        ];
    }
}
