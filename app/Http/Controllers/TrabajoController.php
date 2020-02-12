<?php

namespace App\Http\Controllers;

use App\Trabajo;
use App\Mantenimiento;
use App\User;
use App\Empleado;
use Illuminate\Http\Request;

class TrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trabajo  $trabajo
     * @return \Illuminate\Http\Response
     */
    public function show(Trabajo $trabajo)
    {
        $mantenimiento = Mantenimiento::findOrFail($trabajo->id);
        return view('trabajos.create', compact('mantenimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trabajo  $trabajo
     * @return \Illuminate\Http\Response
     */
    public function edit(Trabajo $trabajo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trabajo  $trabajo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trabajo $trabajo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trabajo  $trabajo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trabajo $trabajo)
    {
        //
    }
}
