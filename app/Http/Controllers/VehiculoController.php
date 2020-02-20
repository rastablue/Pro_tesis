<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Caffeinated\Shinobi\Models\Role;
use App\Vehiculo;
use App\User;
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
        $vehiculo = Vehiculo::paginate(8);

        return view('vehiculos.index', compact('vehiculo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehiculos.create', compact('marca'));
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

        if ($id_users = User::where('cedula', $ced)->first()) {
            $id_users = User::where('cedula', $ced)->first()->id;

            if($id_clie = Cliente::where('user_id', $id_users)->first()){
                $id_clie = Cliente::where('user_id', $id_users)->first()->id;

                $vehiculo = new Vehiculo();
                $vehiculo->placa = $request->placa;
                $vehiculo->marca_vehiculo_id = $request->marca;
                $vehiculo->modelo = $request->modelo;
                $vehiculo->color = $request->color;
                $vehiculo->observacion = $request->observa;
                $vehiculo->cliente_id = $id_clie;
                $vehiculo->save();

                return redirect()->route('vehiculos.index')
                        ->with('info', 'Vehiculo creado con exito');
            }else {
                return abort(503);
            }
    
        }else {
            return abort(503);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehiculo  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Vehiculo $vehiculo)
    {
        $cliente = Vehiculo::findOrFail($vehiculo->id)->clientes->user_id;
        $user = User::get()->where('id', $cliente);

        return view('vehiculos.show', compact('vehiculo', 'user'));
    }

    public function search(Request $request)
    {
        $vehiculo = Vehiculo::where('placa', 'LIKE', "%$request->search%");

        return view('vehiculos.search', compact('vehiculo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehiculo $vehiculo)
    {
        $cliente = Vehiculo::findOrFail($vehiculo->id)->clientes->user_id;
        $user = User::get()->where('id', $cliente);

        return view('vehiculos.edit', compact('vehiculo', 'user'));
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
        $ced = $request->user_id;

        if($id_users = User::where('cedula', $ced)->first()){
            $id_users = User::where('cedula', $ced)->first()->id;

            if($id_clie = Cliente::where('user_id', $id_users)->first()){
                $id_clie = Cliente::where('user_id', $id_users)->first()->id;
                
                $vehiculo = Vehiculo::findOrFail($id);
                $vehiculo->placa = $request->placa;
                $vehiculo->marca_vehiculo_id = $request->marca;
                $vehiculo->modelo = $request->modelo;
                $vehiculo->color = $request->color;
                $vehiculo->observacion = $request->observa;
                $vehiculo->cliente_id = $id_clie;

                $vehiculo->save();

                return redirect()->route('vehiculos.index')
                        ->with('info', 'Usuario actualizado con exito');
            }else{
                return abort(503);
            }
        }else{
            return abort(503);   
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

        return back()->with('info', 'Vehiculo eliminado');
    }
}
