<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMantenimientoFromVehiculo extends FormRequest
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
            "fecha_ingreso" => "required|date_format:Y-m-d",
            "diagnostico" => "required|string|max:500",
            "observacion_mantenimiento" => "required|string|max:500",
            "foto" => "image|mimes:jpg,jpeg,png|max:3000",
        ];
    }
}
