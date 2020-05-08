<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Requests\CreateMantenimiento;
use App\Http\Requests\CreateMantenimientoFromVehiculo;
use App\Http\Requests\CreateClienteFromMantenimiento;
use App\Http\Requests\CreateVehiculoFromMantenimiento;
use App\Http\Requests\CreateAmbosFromMantenimiento;
use App\Http\Requests\EditMantenimiento;
use App\Http\Requests\FechaPdfMantenimiento;
use Barryvdh\DomPDF\Facade as PDF;
use App\Mantenimiento;
use App\Cliente;
use App\Vehiculo;
use Carbon\Carbon;
use yajra\Datatables\Datatables;
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
        $mantenimientos = Mantenimiento::join('vehiculos', 'vehiculos.id', '=', 'mantenimientos.vehiculo_id')
                            ->select('mantenimientos.id', 'vehiculos.placa', 'mantenimientos.nro_ficha',
                                    'mantenimientos.fecha_ingreso', 'mantenimientos.fecha_egreso',
                                    'mantenimientos.estado', 'mantenimientos.valor_total',
                                    'mantenimientos.observacion', 'mantenimientos.diagnostico');

        return Datatables::of($mantenimientos)
            ->addColumn('btn', 'mantenimientos.actions')
            ->rawColumns(['btn'])
            ->make(true);
    }

    //Reportes PDFs
        public function reportes()
        {
            $mantenimiento = Mantenimiento::all();

            $pdf = PDF::loadView('pdfs.reporte-mantenimientos', compact('mantenimiento'));

            return $pdf->download('reporte-mantenimientos.pdf');
        }

        public function reportesActivo()
        {
            $mantenimiento = Mantenimiento::where('estado', 'Activo')->get();

            $pdf = PDF::loadView('pdfs.reporte-mantenimientos', compact('mantenimiento'));

            return $pdf->download('reporte-mantenimientos-activos.pdf');
        }

        public function reportesEspera()
        {
            $mantenimiento = Mantenimiento::where('estado', 'En espera')->get();

            $pdf = PDF::loadView('pdfs.reporte-mantenimientos', compact('mantenimiento'));

            return $pdf->download('reporte-mantenimientos-espera.pdf');
        }

        public function reportesInactivo()
        {
            $mantenimiento = Mantenimiento::where('estado', 'Inactivo')->get();

            $pdf = PDF::loadView('pdfs.reporte-mantenimientos', compact('mantenimiento'));

            return $pdf->download('reporte-mantenimientos-inactivos.pdf');
        }

        public function reportesFinalizado()
        {
            $mantenimiento = Mantenimiento::where('estado', 'Finalizado')->get();

            $pdf = PDF::loadView('pdfs.reporte-mantenimientos', compact('mantenimiento'));

            return $pdf->download('reporte-mantenimientos-finalizados.pdf');
        }

        public function reportesSelect()
        {
            return view('mantenimientos.reportes.fecha');
        }

        public function reportesSelectApply(FechaPdfMantenimiento $request)
        {
            if ($request->customRadio == 1) {
                $mantenimiento = Mantenimiento::whereBetween('fecha_ingreso', [$request->fecha_inicio, $request->fecha_fin])->get();
            }
            
            if ($request->customRadio == 2) {
                $mantenimiento = Mantenimiento::whereBetween('fecha_ingreso', [$request->fecha_inicio, $request->fecha_fin])
                                        ->where('estado', 'Activo')
                                        ->get();
            }

            if ($request->customRadio == 3) {
                $mantenimiento = Mantenimiento::whereBetween('fecha_ingreso', [$request->fecha_inicio, $request->fecha_fin])
                                        ->where('estado', 'En espera')
                                        ->get();
            }

            if ($request->customRadio == 4) {
                $mantenimiento = Mantenimiento::whereBetween('fecha_ingreso', [$request->fecha_inicio, $request->fecha_fin])
                                        ->where('estado', 'Finalizado')
                                        ->get();
            }

            if ($request->customRadio == 5) {
                $mantenimiento = Mantenimiento::whereBetween('fecha_ingreso', [$request->fecha_inicio, $request->fecha_fin])
                                        ->where('estado', 'Inactivo')
                                        ->get();
            }

            $pdf = PDF::loadView('pdfs.reporte-mantenimientos', compact('mantenimiento'));

            return $pdf->download('reporte-mantenimientos.pdf');
        }

        public function pdf($id)
        {
            $id = Hashids::decode($id);
            $mantenimiento = Mantenimiento::findOrFail($id)->first();

            $pdf = PDF::loadView('pdfs.mantenimientos', compact('mantenimiento'));

            return $pdf->download('mantenimiento-'.$mantenimiento->codigo.'.pdf');
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

    public function confirmaCliente(Request $request)
    {
        $vehiculo = Vehiculo::where('placa', $request->placa)->first();
        return view('mantenimientos.confirmacion.createcliente', compact('request', 'vehiculo'));
    }

    public function confirmaVehiculo(Request $request)
    {
        $cliente = Cliente::where('cedula', $request->cedula)->first();
        return view('mantenimientos.confirmacion.createvehiculo', compact('request', 'cliente'));
    }

    public function confirmaAmbos(Request $request)
    {
        return view('mantenimientos.confirmacion.createambos', compact('request'));
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
        ********Busca al mantenimiento, si ya existe, se regresa
        ********a la vista mediante back() ademas el cliente y el vehiculo
        ********ya deben existir previamente
        */
            if (Cliente::where('cedula', $request->cedula)->first() && Vehiculo::where('placa', $request->placa)->first()) {
                if (Mantenimiento::where('nro_ficha', $request->codigo)->first()) {

                    return back()->with('danger', 'Error, la ficha con este codigo ya existe');
                    
                } else {

                    $cliente = Cliente::where('cedula', $request->cedula)->first();
                    $vehiculo = Vehiculo::where('placa', $request->placa)->first();

                    $vehiculo->cliente_id = $cliente->id;
                    $vehiculo->save();

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

        /*
        ********Si el cliente y/o el vehiculo no existen,
        ********seran redirigidos a una ventana de confirmacion
        ********para crear el cliente o el vehiculo o ambos.
        */
            if (!Cliente::where('cedula', $request->cedula)->first() && Vehiculo::where('placa', $request->placa)->first()) {
                $vehiculo = Vehiculo::where('placa', $request->placa)->first();

                return view('mantenimientos.confirmacion.cliente', compact('request', 'vehiculo'));

            }

            if (Cliente::where('cedula', $request->cedula)->first() && !Vehiculo::where('placa', $request->placa)->first()) {
                $cliente = Cliente::where('cedula', $request->cedula)->first();

                return view('mantenimientos.confirmacion.vehiculo', compact('request', 'cliente'));

            }

            if (!Cliente::where('cedula', $request->cedula)->first() && !Vehiculo::where('placa', $request->placa)->first()) {

                return view('mantenimientos.confirmacion.ambos', compact('request'));

            }        
            
    }

    public function clienteStore(CreateClienteFromMantenimiento $request)
    {

        $clientes = new Cliente();

        $clientes->cedula = $request->cedula;
        $clientes->name = $request->nombre;
        $clientes->apellido_pater = $request->apellido_paterno;
        $clientes->apellido_mater = $request->apellido_materno;
        $clientes->direc = $request->direccion;
        $clientes->tlf = $request->telefono;
        $clientes->email = $request->email;

        if (Mantenimiento::where('nro_ficha', $request->codigo)->first()) {

            return redirect()->route('mantenimientos.index')->with('danger', 'Error, la ficha con este codigo ya existe');

        } else {
            
            $clientes->save();
    
            $cliente = Cliente::where('cedula', $request->cedula)->first();

            $vehiculo = Vehiculo::where('placa', $request->placa)->first();

            $vehiculo->cliente_id = $cliente->id;
            $vehiculo->save();

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

    public function vehiculoStore(CreateVehiculoFromMantenimiento $request)
    {
        if (Mantenimiento::where('nro_ficha', $request->codigo)->first()) {

            return redirect()->route('mantenimientos.index')->with('danger', 'Error, la ficha con este codigo ya existe');

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

    public function amboStore(CreateAmbosFromMantenimiento $request)
    {
        if (Mantenimiento::where('nro_ficha', $request->codigo)->first()) {

            return redirect()->route('mantenimientos.index')->with('danger', 'Error, la ficha con este codigo ya existe');

        } else {

            $clientes = new Cliente();

            $clientes->cedula = $request->cedula;
            $clientes->name = $request->nombre;
            $clientes->apellido_pater = $request->apellido_paterno;
            $clientes->apellido_mater = $request->apellido_materno;
            $clientes->direc = $request->direccion;
            $clientes->tlf = $request->telefono;
            $clientes->email = $request->email;

            $clientes->save();

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

            $vehiculo->save();

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

                foreach ($mantenimiento->trabajos->all() as $key) {
                    $key->estado = 'Finalizado';

                    $key->save();
                }
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

    public function activo(request $request, $id)
    {

        $mantenimiento = Mantenimiento::findOrFail($id);

        if ($mantenimiento->estado != 'Activo') {

            $mantenimiento->estado = 'Activo';

            $mantenimiento->save();

        }
    }

    public function espera(request $request, $id)
    {

        $mantenimiento = Mantenimiento::findOrFail($id);

        if ($mantenimiento->estado != 'En espera') {

            $mantenimiento->estado = 'En espera';

            $mantenimiento->save();

        }
    }

    public function inactivo(request $request, $id)
    {

        $mantenimiento = Mantenimiento::findOrFail($id);

        if ($mantenimiento->estado != 'Inactivo') {

            $mantenimiento->estado = 'Inactivo';

            $mantenimiento->save();

            foreach ($mantenimiento->trabajos->all() as $key) {
                $key->estado = 'Inactivo';

                $key->save();
            }

        }
    }

    public function finalizar(request $request, $id)
    {

        $mantenimiento = Mantenimiento::findOrFail($id);

        if ($mantenimiento->estado != 'Finalizado') {

            $mantenimiento->estado = 'Finalizado';

            $mantenimiento->save();

            foreach ($mantenimiento->trabajos->all() as $key) {
                $key->estado = 'Finalizado';

                $key->save();
            }

        }
    }

    //Finaliza el Mantenimiento desde el dataTable
    public function finalizarM(request $request, $id)
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
