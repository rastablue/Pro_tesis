<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Trabajo;
use App\Mantenimiento;
use App\User;
use App\Empleado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

class TrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trabajos = Trabajo::paginate(8);
        return view('trabajos.index', compact('trabajos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($id_users = User::where('cedula', $request->cedula)->first()) {

            $id_users = User::where('cedula', $request->cedula)->first()->id;
            $id_empleado = Empleado::where('user_id', $id_users)->first()->id;

            $trabajo = new Trabajo();
            $trabajo->manobra = $request->manobra;
            $trabajo->repuestos = $request->repuestos;
            $trabajo->costo_repuestos = $request->costo_repuestos;
            $trabajo->costo_manobra = $request->costo_manobra;
            $trabajo->estado = 'activo';
            $trabajo->tipo = $request->tipo;
            $trabajo->mantenimiento_id = $request->id_mante;
            $trabajo->empleado_id = $id_empleado;

            $trabajo->save();

            return redirect()->route('mantenimientos.index')
                    ->with('info', 'Trabajo agregado');
        } else {
            return abort(404);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trabajo  $trabajo
     * @return \Illuminate\Http\Response
     */

    public function show($trabajo)
    {
        $mantenimiento = Mantenimiento::findOrFail($trabajo);
        return view('trabajos.create', compact('mantenimiento'));
    }

    public function pendientes($id)
    {
        if ($empleado = User::findOrFail($id)->empleados) {
            $empleado = User::findOrFail($id)->empleados->id;

            $trabajos = Trabajo::where('empleado_id', $empleado)->get();

            return view('trabajos.show', compact('trabajos'));

        } else {

            return abort(503);

        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trabajo  $trabajo
     * @return \Illuminate\Http\Response
     */
    public function edit(Trabajo $trabajo)
    {
        $mantenimiento = Mantenimiento::where('id', $trabajo->mantenimiento_id)->first();
        return view('trabajos.edit', compact('trabajo', 'mantenimiento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trabajo  $trabajo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $trabajo)
    {
        $id_users = User::where('cedula', $request->cedula)->first()->id;
        $id_empleado = Empleado::where('user_id', $id_users)->first()->id;

        $trabajos = Trabajo::findOrFail($trabajo);

        $trabajos->manobra = $request->manobra;
        $trabajos->repuestos = $request->repuestos;
        $trabajos->costo_repuestos = $request->costo_repuestos;
        $trabajos->costo_manobra = $request->costo_manobra;
        $trabajos->estado = $request->estado;
        $trabajos->tipo = $request->tipo;
        $trabajos->mantenimiento_id = $request->id_mante;
        $trabajos->empleado_id = $id_empleado;

        $trabajos->save();

        return redirect()->route('mantenimientos.index')
                ->with('info', 'Trabajo actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trabajo  $trabajo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trabajo $trabajo)
    {
        $trabajo->delete();

        return back()->with('info', 'Trabajo eliminado');
    }
}
