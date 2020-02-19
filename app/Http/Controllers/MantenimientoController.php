<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Mantenimiento;
use App\Trabajo;
use App\User;
use App\Vehiculo;
use Carbon\Carbon;

class MantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mantenimiento = Mantenimiento::paginate(8);

        return view('mantenimientos.index', compact('mantenimiento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mantenimientos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = Carbon::now();

        $vehi_id = Vehiculo::where('placa', $request->placa)->first();

        if ($vehi_id) {
            $mantenimiento = new Mantenimiento();
            $mantenimiento->nro_ficha = $request->ficha;
            $mantenimiento->fecha_ingreso = $date;
            $mantenimiento->observacion = $request->observacion;
            $mantenimiento->vehiculo_id = $vehi_id->id;
            $mantenimiento->estado = 'activo';
            $mantenimiento->diagnostico = $request->diagnostico;
            $mantenimiento->kilometraje = $request->kilometraje;

            $mantenimiento->save();

            return redirect()->route('mantenimientos.index')
                    ->with('info', 'Mantenimiento agregado');
        } else {
            return abort(404);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mantenimiento  mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Mantenimiento $mantenimiento)
    {
        $valor = DB::table('trabajos')
                    ->selectRaw('val_total(9)')->get();
        return view('mantenimientos.show', compact('mantenimiento', 'valor'));
    }

    public function search(Request $request)
    {
        $mantenimiento = Mantenimiento::where('nro_ficha', 'LIKE', "%$request->search%");

        return view('mantenimientos.search', compact('mantenimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Mantenimiento $mantenimiento)
    {
        return view('mantenimientos.edit', compact('mantenimiento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$mantenimiento->update($request->all());
        //actualiza usuario
        $vehi_id = Vehiculo::where('placa', $request->placa)->first();
        $date = Carbon::now();

        $mantenimiento = Mantenimiento::findOrFail($id);

        $mantenimiento->nro_ficha = $request->ficha;
        $mantenimiento->fecha_egreso = $date;
        $mantenimiento->observacion = $request->observacion;
        $mantenimiento->vehiculo_id = $vehi_id->id;
        $mantenimiento->estado = $request->estado;
        $mantenimiento->diagnostico = $request->diagnostico;
        $mantenimiento->kilometraje = $request->kilometraje;

        $mantenimiento->save();

        return redirect()->route('mantenimientos.index')
                ->with('info', 'Mantenimiento actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mantenimiento $mantenimiento)
    {
        $mantenimiento->delete();

        return back()->with('info', 'Usuario eliminado');
    }
}
