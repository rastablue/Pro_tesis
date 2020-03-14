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
use App\Vehiculo;
use App\User;
use App\Cliente;
use App\MarcaVehiculo;

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
                    return $vehiculos->marcas->marca;
                })
                ->addColumn('btn', 'vehiculos.actions')
                ->rawColumns(['btn'])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($vehiculo)
    {
        $id = Hashids::decode($vehiculo);
        $cliente = Cliente::findOrFail($id)->first();
        return view('vehiculos.create', compact('cliente'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ced = $request->user_id;

        if($id_clie = Cliente::where('cedula', $ced)->first()){
            $id_clie = Cliente::where('cedula', $ced)->first()->id;


            if ($placa = Vehiculo::where('placa', $request->placa)->first()){

                return back()->with('danger', 'Error, la placa ya existe');

            } else {

                if ($marca = MarcaVehiculo::where('id', $request->marca)->first()) {

                    $vehiculo = new Vehiculo();

                    $vehiculo->placa = $request->placa;
                    $vehiculo->marca_vehiculo_id = $request->marca;
                    $vehiculo->modelo = $request->modelo;
                    $vehiculo->color = $request->color;
                    $vehiculo->kilometraje = $request->kilometraje;
                    $vehiculo->observacion = $request->observa;
                    $vehiculo->cliente_id = $id_clie;
                    $vehiculo->save();

                    return redirect()->route('vehiculos.index')
                            ->with('info', 'Vehiculo agregado con exito');

                } else {

                    return back()->with('danger', 'Error, la Marca no existe');

                }

            }

        }else{
            return back()
                    ->with('danger', 'Error, el Cliente no existe');
        }

    }

    public function storeDirect(Request $request)
    {
        $ced = $request->user_id;

        if($id_clie = Cliente::where('cedula', $ced)->first()){
            $id_clie = Cliente::where('cedula', $ced)->first()->id;

            if ($placa = Vehiculo::where('placa', $request->placa)->first()){

                return back()->with('danger', 'Error, la placa ya existe');

            } else {

                if ($marca = MarcaVehiculo::where('id', $request->marca)->first()) {

                    $vehiculo = new Vehiculo();

                    $vehiculo->placa = $request->placa;
                    $vehiculo->marca_vehiculo_id = $request->marca;
                    $vehiculo->modelo = $request->modelo;
                    $vehiculo->color = $request->color;
                    $vehiculo->kilometraje = $request->kilometraje;
                    $vehiculo->observacion = $request->observa;
                    $vehiculo->cliente_id = $id_clie;
                    $vehiculo->save();

                    return redirect()->route('clientes.show', Hashids::encode($id_clie))
                            ->with('info', 'Vehiculo agregado con exito');
                } else {
                    return back()
                            ->with('danger', 'Error, la Marca no existe');
                }
            }

        }else{
            return back()
                ->with('danger', 'Error, el Cliente no existe');
        }

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
        $marcas = MarcaVehiculo::all();

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
    public function update(Request $request, $id)
    {

        /*$validator = Validator::make($request->all(), [
            'placa' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'color' => 'required',
            'observacion' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        $vehiculo = Vehiculo::findOrFail($id);
        $vehiculo->update($request->all());

        return response()->json(['success'=>'Product updated successfully']);*/

        $ced = $request->user_id;

        if($id_clie = Cliente::where('cedula', $ced)->first()){
            $id_clie = Cliente::where('cedula', $ced)->first()->id;


            if ($marca = MarcaVehiculo::where('id', $request->marca)->first()) {
                $vehiculo = Vehiculo::findOrFail($id);
                $vehiculo->marca_vehiculo_id = $request->marca;
                $vehiculo->modelo = $request->modelo;
                $vehiculo->color = $request->color;
                $vehiculo->kilometraje = $request->kilometraje;
                $vehiculo->observacion = $request->observa;
                $vehiculo->cliente_id = $id_clie;
                $vehiculo->save();
                return redirect()->route('vehiculos.index')
                        ->with('info', 'Vehiculo actualizado con exito');
            } else {
                return redirect()->route('vehiculos.index')
                        ->with('danger', 'Error, la Marca no existe');
            }

        }else{
            return redirect()->route('vehiculos.index')
                ->with('danger', 'Error, el Cliente no existe');
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
