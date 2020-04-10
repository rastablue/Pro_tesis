<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVehiculoFromCliente extends FormRequest
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
            "placa" => "required|string|max:8|unique:vehiculos,placa",
            "marca" => "required|string|max:30",
            "modelo" => "required|string|max:30",
            "color" => "string|max:50",
            "kilometraje" => "digits_between:0,7",
            "tipo" => "string|max:50",
            "observacion_vehiculo" => "string|max:500",
        ];
    }
}
