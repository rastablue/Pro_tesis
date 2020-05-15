<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mantenimiento;

class LogoutController extends Controller
{
    public function consulta(Request $request)
    {
        $mantenimiento = Mantenimiento::where('nro_ficha', $request->buscar)->first();

        if ($mantenimiento) {
            return view('consulta', compact('mantenimiento'));
        } else {
            return back()->with('danger', 'Error, no se encontro el mantenimiento');
        }

    }
}
