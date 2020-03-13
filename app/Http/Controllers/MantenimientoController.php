<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Vinkla\Hashids\Facades\Hashids;
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

    public function mantenimientoData()
    {

        return Datatables()
                ->eloquent(Mantenimiento::query())
                /*->addColumn('btn', function($vehiculos){
                    return '<button type="button" class="btn btn-warning btn-sm" id="getEditProductData" data-id="'.$vehiculos->id.'">Edit</button>
                    <button type="button" data-id="'.$vehiculos->id.'" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';

                })*/
                ->addColumn('btn', 'mantenimientos.actions')
                ->rawColumns(['btn'])
                ->make(true);
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
            return back() ->with('danger', 'Error, la Ficha ya fue ingresada');
        } else {
            if ($vehi_id) {
                $mantenimiento = new Mantenimiento();
                $mantenimiento->nro_ficha = $request->ficha;
                $mantenimiento->fecha_ingreso = $date;
                $mantenimiento->observacion = $request->observacion;
                $mantenimiento->vehiculo_id = $vehi_id->id;
                $mantenimiento->estado = 'activo';
                $mantenimiento->diagnostico = $request->diagnostico;


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
                return back() ->with('danger', 'Error, el Vehiculo no existe');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mantenimiento  mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function show($mantenimiento)
    {
        $id = Hashids::decode($mantenimiento);
        $mantenimiento = Mantenimiento::findOrFail($id)->first();

        return view('mantenimientos.show', compact('mantenimiento'));
    }

    public function ficha($mantenimiento)
    {
        $id = Hashids::decode($mantenimiento);
        $mantenimiento = Mantenimiento::findOrFail($id)->first();

        return view('mantenimientos.ficha', compact('mantenimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function edit($mantenimiento)
    {
        $id = Hashids::decode($mantenimiento);
        $mantenimiento = Mantenimiento::findOrFail($id)->first();

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
            return back() ->with('danger', 'Error, el vehiculo no existe');
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
    }
}
