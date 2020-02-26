<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $mantenimiento = Mantenimiento::paginate(5);

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
        $nFicha = $request->ficha;

        if ($nro_ficha = Mantenimiento::where('nro_ficha', $nFicha)->first()) {
            return back() ->with('info', 'La Ficha ya fue ingresada');
        } else {
            if ($vehi_id) {
                $mantenimiento = new Mantenimiento();
                $mantenimiento->nro_ficha = $request->ficha;
                $mantenimiento->fecha_ingreso = $date;
                $mantenimiento->observacion = $request->observacion;
                $mantenimiento->vehiculo_id = $vehi_id->id;
                $mantenimiento->estado = 'activo';
                $mantenimiento->diagnostico = $request->diagnostico;
                $mantenimiento->kilometraje = $request->kilometraje;


                if ($request->hasFile('file')) {
                    $image = $request->file->store('public');
                    $mantenimiento->path = $image;
                }
                 $mantenimiento->save();
                /*if($request->hasFile('ficha')){
                    $path = Storage::disk('public')->put('imagesLoads', $request->file('ficha'));
                }*/

                return redirect()->route('mantenimientos.index')
                        ->with('info', 'Mantenimiento agregado');
            } else {
                return back() ->with('info', 'El Vehiculo no existe');
            }
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
        return view('mantenimientos.show', compact('mantenimiento'));
    }

    public function ficha(Mantenimiento $mantenimiento)
    {
        return view('mantenimientos.ficha', compact('mantenimiento'));
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

        if($vehi_id){

            $mantenimiento = Mantenimiento::findOrFail($id);

            $mantenimiento->nro_ficha = $request->ficha;
            $mantenimiento->observacion = $request->observacion;
            $mantenimiento->vehiculo_id = $vehi_id->id;
            $mantenimiento->estado = $request->estado;
            $mantenimiento->diagnostico = $request->diagnostico;
            $mantenimiento->kilometraje = $request->kilometraje;
            if ($request->estado == 'Finalizado') {
                $mantenimiento->fecha_egreso = $date;
            }
            if ($request->hasFile('file')) {
                $image = $request->file->store('public');
                $mantenimiento->path = $image;
            }

            $mantenimiento->save();

            return redirect()->route('mantenimientos.index')
                    ->with('info', 'Mantenimiento actualizado');
        }else{
            return back() ->with('info', 'El vehiculo no existe');
        }


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
