<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Caffeinated\Shinobi\Models\Role;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Crypt;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Requests\CreateVehiculo;
use App\Http\Requests\CreateVehiculoFromCliente;
use App\Http\Requests\EditVehiculo;
use Barryvdh\DomPDF\Facade as PDF;
use App\Vehiculo;
use App\User;
use App\Cliente;
use App\Marca;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehiculo = Vehiculo::paginate(5);

        return view('vehiculos.index', compact('vehiculo'));
    }

    public function vehiculoData()
    {
        $vehiculos = Vehiculo::all();
        /*$marcas = Vehiculo::join('marca_vehiculos', 'marca_vehiculos.id', '=', 'vehiculos.marca_vehiculo_id')
                    ->select('vehiculos.id', 'marca_vehiculos.marca', 'vehiculos.modelo');*/
        return Datatables()
                ->eloquent(Vehiculo::query())
                ->addColumn('marca', function($vehiculos){
                    if ($vehiculos->marca_id) {
                        return $vehiculos->marcas->marca;
                    } else {
                        return 'N/A';
                    }
                })
                ->addColumn('btn', 'vehiculos.actions')
                ->rawColumns(['btn'])
                ->make(true);
    }

    public function reportes()
    {
        /**
         * toma en cuenta que para ver los mismos
         * datos debemos hacer la misma consulta
        **/
        $vehiculo = Vehiculo::all();

        $pdf = PDF::loadView('pdfs.reporte-vehiculos', compact('vehiculo'));

        return $pdf->download('reporte-vehiculos.pdf');
    }

    public function pdf($id)
    {
        /**
         * toma en cuenta que para ver los mismos
         * datos debemos hacer la misma consulta
        **/
        $id = Hashids::decode($id);
        $vehiculo = Vehiculo::findOrFail($id)->first();

        $pdf = PDF::loadView('pdfs.vehiculos', compact('vehiculo'));

        return $pdf->download('vehiculo-'.$vehiculo->placa.'.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehiculos.create');
    }

    public function createfromcliente($cliente)
    {
        $id = Hashids::decode($cliente);
        $cliente = Cliente::findOrFail($id)->first();
        return view('vehiculos.createfromcliente', compact('cliente'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateVehiculo $request)
    {
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

                if (!$vehiculo->save()) {
                    return back()->with('danger', 'Error, No se pudo agregar el vehiculo');
                }

                $vehiculo->save();

                return redirect()->route('vehiculos.show', Hashids::encode(vehiculo::where('placa', $request->placa)->first()->id))
                        ->with('info', 'El vehiculo ya existia, pero se han actualizado algunos datos');

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

                return redirect()->route('vehiculos.show', Hashids::encode(vehiculo::where('placa', $request->placa)->first()->id))
                        ->with('info', 'Vehiculo agregado');
            }

    }

    public function storefromcliente(CreateVehiculoFromCliente $request)
    {
        /*
        ********Crea un vehiculo desde la vista clientes.show.
        ********Busca al vehiculo, si ya existe, se actualizan
        ********determinados campos, caso contrario, el
        ********vehiculo se crea.
        */

            $vehiculo = New Vehiculo();

            $vehiculo->placa = $request->placa;
            $vehiculo->modelo = $request->modelo;
            $vehiculo->color = $request->color;
            $vehiculo->kilometraje = $request->kilometraje;
            $vehiculo->tipo_vehiculo = $request->tipo;
            $vehiculo->observacion = $request->observacion_vehiculo;
            $vehiculo->cliente_id = $request->id_cliente;
            $vehiculo->marca_id = $request->marca;

            if (!$vehiculo->save()) {
                return back()->with('danger', 'Error, No se pudo agregar el vehiculo');
            }

            $vehiculo->save();

            return redirect()->route('vehiculos.show', Hashids::encode(vehiculo::where('placa', $request->placa)->first()->id))
                    ->with('info', 'Vehiculo agregado');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehiculo  $user
     * @return \Illuminate\Http\Response
     */
    public function show($vehiculo)
    {
        $id = Hashids::decode($vehiculo);
        $vehiculo = Vehiculo::findOrFail($id)->first();

        return view('vehiculos.show', compact('vehiculo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit($vehiculo)
    {
        $id = Hashids::decode($vehiculo);
        $vehiculo = Vehiculo::findOrFail($id)->first();

        return view('vehiculos.edit', compact('vehiculo'));

        /*$data = $vehiculo;
        $marcas = Marca::all();

        $html = '<div class="form-group">
                    <label for="Placa">Placa</label>
                    <input type="text" class="form-control" name="placa" id="placa" value="'.$vehiculo->placa.'">
                </div>
                <div class="form-group">
                    <label for="Marca">Marca</label>

                        <select id="marca" class="form-control" name="marca">
                            <option value="'.$vehiculo->marcas->id.'" selected="true">'.$vehiculo->marcas->marca.'</option>
                            @foreach('.$marcas.')
                                <option value="{{ $marcas->id }}">  '.$marcas->first()->marca.'  </option>
                            @endforeach
                        </select>

                </div>
                <div class="form-group">
                    <label for="Modelo">Modelo</label>
                    <input type="text" class="form-control" name="modelo" id="modelo" value="'.$vehiculo->modelo.'">
                </div>
                <div class="form-group">
                    <label for="Color">Color</label>
                    <input type="text" class="form-control" name="color" id="color" value="'.$vehiculo->color.'">
                </div>
                <div class="form-group">
                    <label for="Obrsevacion">Observacion:</label>
                    <textarea class="form-control" name="observa" id="observa">'.$vehiculo->observacion.'
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="user_id">Cedula del Cliente</label>
                    <input type="text" class="form-control" name="user_id" id="user_id" pattern="[0-9]{10}" placeholder="'.$vehiculo->clientes->users->cedula.'" value="'.$vehiculo->clientes->users->cedula.'" required autocomplete="user_id" autofocus>
                </div>';

        return response()->json(['html'=>$html]);*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(EditVehiculo $request, $id)
    {

        $ced = $request->cedula;

        if($id_clie = Cliente::where('cedula', $ced)->first()){
            $id_clie = Cliente::where('cedula', $ced)->first()->id;

                $vehiculo = Vehiculo::findOrFail($id);
                $vehiculo->color = $request->color;
                $vehiculo->kilometraje = $request->kilometraje;
                $vehiculo->observacion = $request->observacion_vehiculo;
                $vehiculo->cliente_id = $id_clie;
                $vehiculo->save();

                return redirect()->route('vehiculos.show', Hashids::encode($vehiculo->id))
                        ->with('info', 'Vehiculo actualizado');

        }else{
            return back()->with('danger', 'Error, el Cliente no existe');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehiculo  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();
    }
}
