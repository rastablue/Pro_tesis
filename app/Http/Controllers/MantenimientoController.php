<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Requests\CreateMantenimiento;
use App\Http\Requests\CreateMantenimientoFromVehiculo;
use App\Http\Requests\EditMantenimiento;
use Barryvdh\DomPDF\Facade as PDF;
use App\Mantenimiento;
use App\Trabajo;
use App\User;
use App\Cliente;
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
        $mantenimiento = Mantenimiento::all();

        return Datatables()
                ->eloquent(Mantenimiento::query())
                ->addColumn('placa', function($mantenimiento){
                    if ($mantenimiento->vehiculo_id) {
                        return $mantenimiento->vehiculos->placa;
                    } else {
                        return 'N/A';
                    }
                })
                ->addColumn('btn', 'mantenimientos.actions')
                ->rawColumns(['btn'])
                ->make(true);
    }

    //Crea un PDF de todos los mantenimientos
    public function reportes()
    {
        $mantenimiento = Mantenimiento::all();

        $pdf = PDF::loadView('pdfs.reporte-mantenimientos', compact('mantenimiento'));

        return $pdf->download('reporte-mantenimientos.pdf');
    }

    //Crea un PDF detallado de un mantenimiento en especifico
    public function pdf($id)
    {
        $id = Hashids::decode($id);
        $mantenimiento = Mantenimiento::findOrFail($id)->first();

        $pdf = PDF::loadView('pdfs.mantenimientos', compact('mantenimiento'));

        return $pdf->download('mantenimiento-'.$mantenimiento->nro_ficha.'.pdf');
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

    public function createfromvehiculo($vehiculo)
    {
        $id = Hashids::decode($vehiculo);
        $vehiculo = Vehiculo::findOrFail($id)->first();
        return view('mantenimientos.createfromvehiculo', compact('vehiculo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMantenimiento $request)
    {
        $date = Carbon::now();
        /*
        ********Busca al cliente, si ya existe, se actualizan
        ********determinados campos, caso contrario, el
        ********cliente se crea
        */
            if (Cliente::where('cedula', $request->cedula)->first()) {
                $cliente = Cliente::where('cedula', $request->cedula)->first();

                $cliente->direc = $request->direccion;
                $cliente->tlf = $request->telefono;
                $cliente->email = $request->email;

                $cliente->save();

            } else {
                $cliente = New Cliente();

                $cliente->cedula = $request->cedula;
                $cliente->name = $request->nombre;
                $cliente->apellido_pater = $request->apellido_paterno;
                $cliente->apellido_mater = $request->apellido_materno;
                $cliente->direc = $request->direccion;
                $cliente->tlf = $request->telefono;
                $cliente->email = $request->email;

                if (!$cliente->save()) {
                    return back()->with('danger', 'Error, No se pudo agregar al cliente');
                }

                $cliente->save();
            }

        /*
        ********Busca al vehiculo, si ya existe, se actualizan
        ********determinados campos, caso contrario, el
        ********vehiculo se crea
        */
            if (Vehiculo::where('placa', $request->placa)->first()) {
                $vehiculo = Vehiculo::where('placa', $request->placa)->first();
                $cliente = Cliente::where('cedula', $request->cedula)->first();

                $vehiculo->color = $request->color;
                $vehiculo->kilometraje = $request->kilometraje;
                $vehiculo->tipo_vehiculo = $request->tipo;
                $vehiculo->observacion = $request->observacion_vehiculo;
                $vehiculo->cliente_id = $cliente->id;

                $vehiculo->save();

            } else {
                $cliente = Cliente::where('cedula', $request->cedula)->first();

                $vehiculo = New Vehiculo();

                $vehiculo->placa = $request->placa;
                $vehiculo->modelo = $request->modelo;
                $vehiculo->color = $request->color;
                $vehiculo->kilometraje = $request->kilometraje;
                $vehiculo->tipo_vehiculo = $request->tipo;
                $vehiculo->observacion = $request->observacion_vehiculo;
                $vehiculo->cliente_id = $cliente->id;
                $vehiculo->marca_id = $request->marca;

                if (!$vehiculo->save()) {
                    return back()->with('danger', 'Error, No se pudo agregar el vehiculo');
                }

                $vehiculo->save();
            }

        /*
        ********Busca al mantenimiento, si ya existe, se regresa
        ********a la vista mediante back() notificando que la ficha
        ********ya existe, caso contrario, la ficha se crea
        */
            if (Mantenimiento::where('nro_ficha', $request->codigo)->first()) {

                return back()->with('danger', 'Error, la ficha con este codigo ya existe');
            } else {

                $vehiculo = Vehiculo::where('placa', $request->placa)->first();

                $mantenimiento = New Mantenimiento();

                $mantenimiento->nro_ficha = $request->codigo;
                $mantenimiento->fecha_ingreso = $request->fecha_ingreso;
                $mantenimiento->observacion = $request->observacion_mantenimiento;
                $mantenimiento->diagnostico = $request->diagnostico;
                $mantenimiento->estado = 'En espera';
                $mantenimiento->vehiculo_id = $vehiculo->id;

                if ($request->hasFile('foto')) {
                    $image = $request->foto->store('public');
                    $mantenimiento->path = $image;
                }

                $mantenimiento->save();

                return redirect()->route('mantenimientos.show', Hashids::encode(Mantenimiento::where('nro_ficha', $request->codigo)->first()->id))
                        ->with('info', 'Mantenimiento agregado');
            }
    }

    public function storeFromVehiculo(CreateMantenimientoFromVehiculo $request)
    {
        $date = Carbon::now();

        /*
        ********Busca al mantenimiento, si ya existe, se regresa
        ********a la vista mediante back() notificando que la ficha
        ********ya existe, caso contrario, la ficha se crea
        */

            $mantenimiento = New Mantenimiento();

            $mantenimiento->nro_ficha = $request->codigo;
            $mantenimiento->fecha_ingreso = $request->fecha_ingreso;
            $mantenimiento->observacion = $request->observacion_mantenimiento;
            $mantenimiento->diagnostico = $request->diagnostico;
            $mantenimiento->estado = 'En espera';
            $mantenimiento->vehiculo_id = $request->id_vehiculo;

            if ($request->hasFile('foto')) {
                $image = $request->foto->store('public');
                $mantenimiento->path = $image;
            }

            $mantenimiento->save();

            return redirect()->route('mantenimientos.show', Hashids::encode(Mantenimiento::where('nro_ficha', $request->codigo)->first()->id))
                    ->with('info', 'Mantenimiento agregado');

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

        if ($mantenimiento->estado == 'Finalizado') {
            return back()->with('danger', 'Error, este mantenimiento ya no puede actualizarse');
        } else {
            return view('mantenimientos.edit', compact('mantenimiento'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function update(EditMantenimiento $request, $id)
    {

        $date = Carbon::now();

        $mantenimiento = Mantenimiento::findOrFail($id);

        if ($mantenimiento->estado != 'Finalizado') {

            $mantenimiento->observacion = $request->observacion;
            $mantenimiento->estado = $request->estado;
            $mantenimiento->diagnostico = $request->diagnostico;

            if ($request->estado == 'Finalizado') {
                $mantenimiento->fecha_egreso = $date;
            }
            if ($request->hasFile('foto')) {
                $image = $request->foto->store('public');
                $mantenimiento->path = $image;
            }

            $mantenimiento->save();

            return redirect()->route('mantenimientos.show', Hashids::encode($mantenimiento->id))
                    ->with('info', 'Mantenimiento actualizado');

        } else {
            return redirect()->route('mantenimientos.show', Hashids::encode($mantenimiento->id))
                    ->with('danger', 'El mantenimiento ya habia finalizado por lo cual no se actualizo');
        }

    }

    //Finaliza el Mantenimiento desde el dataTable
    public function finalizar(request $request, $id)
    {

        $date = Carbon::now();

        $mantenimiento = Mantenimiento::findOrFail($id);

        if ($mantenimiento->estado != 'Finalizado') {

            $mantenimiento->estado = 'Finalizado';
            $mantenimiento->fecha_egreso = $date;

            $mantenimiento->save();

            foreach ($mantenimiento->trabajos->all() as $key) {
                $key->estado = 'Finalizado';

                $key->save();
            }

        }
    }

    //Finaliza el Mantenimiento desde la vista SHOW
    public function finalizarFrom($id)
    {
        $date = Carbon::now();

        $mantenimiento = Mantenimiento::findOrFail($id);

        if ($mantenimiento->estado != 'Finalizado') {

            $mantenimiento->estado = 'Finalizado';
            $mantenimiento->fecha_egreso = $date;

            $mantenimiento->save();

            foreach ($mantenimiento->trabajos->all() as $key) {
                $key->estado = 'Finalizado';

                $key->save();
            }

            return back()->with('info', 'Este mantenimiento ha finalizado correctamente');
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
