<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVehiculoFromMantenimiento extends FormRequest
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
            "codigo" => "required|digits:7|unique:mantenimientos,nro_ficha",
            "diagnostico" => "required|string|max:500",
            "observacion_mantenimiento" => "string|max:500",
            "foto" => "image|mimes:jpg,jpeg,png|max:3000",

            "placa" => "required|string|max:12|unique:vehiculos,placa",
            "marca" => "required|string|max:30|exists:marcas,id",
            "modelo" => "required|string|max:30",
            "color" => "string|max:50",
            "kilometraje" => "digits_between:0,7",
            "tipo" => "string|max:50",
            "observacion_vehiculo" => "string|max:500",

            "cedula" => "required|digits:10|exists:clientes,cedula",
        ];
    }
}
