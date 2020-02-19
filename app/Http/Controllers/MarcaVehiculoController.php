<?php

namespace App\Http\Controllers;

use App\MarcaVehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarcaVehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = MarcaVehiculo::paginate(8);
        return view('marcaVehiculos.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marcaVehiculos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $marca = MarcaVehiculo::create($request->all());
        return redirect()->route('marcas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MarcaVehiculo  $marcaVehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(MarcaVehiculo $marcaVehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MarcaVehiculo  $marcaVehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marca = MarcaVehiculo::findOrFail($id);
        return view('marcaVehiculos.edit', compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MarcaVehiculo  $marcaVehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $marcaVehiculo = MarcaVehiculo::findOrFail($id);
        $marcaVehiculo->update($request->all());

        return redirect()->route('marcas.index')
                ->with('info', 'Marca Actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MarcaVehiculo  $marcaVehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $marcaVehiculo = MarcaVehiculo::findOrFail($id);
        $marcaVehiculo->delete();

        return back()->with('info', 'Marca eliminada');
    }
}
