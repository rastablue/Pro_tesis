<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Requests\CreateVehiculo;
use App\Http\Requests\CreateVehiculoFromCliente;
use App\Http\Requests\CreateClienteFromVehiculo;
use App\Http\Requests\EditVehiculo;
use Barryvdh\DomPDF\Facade as PDF;
use App\Vehiculo;
use App\Cliente;

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
        $vehiculos = Vehiculo::join('marcas', 'marcas.id', '=', 'vehiculos.marca_id')
                ->join('clientes', 'clientes.id', '=', 'vehiculos.cliente_id')
                ->select('vehiculos.id', 'vehiculos.placa', 'marcas.marca', 'vehiculos.modelo',
                        'vehiculos.color', 'clientes.name', 'clientes.apellido_pater');

        return Datatables::of($vehiculos)
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

    public function confirmaCliente(Request $request)
    {
        return view('vehiculos.confirmacion.createcliente', compact('request'));
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

            }else{

                return view('vehiculos.confirmacion.confirmar', compact('request'));

            }

    }

    public function clienteStore(CreateClienteFromVehiculo $request)
    {

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

        if (!$vehiculo->save()) {
            return back()->with('danger', 'Error, No se pudo agregar el vehiculo');
        }

        $vehiculo->save();

        return redirect()->route('vehiculos.show', Hashids::encode(vehiculo::where('placa', $request->placa)->first()->id))
                ->with('info', 'Vehiculo agregado');

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
