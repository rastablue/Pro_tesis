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
        $id_users = User::where('cedula', $ced)->first()->id;
        $id_clie = Cliente::where('user_id', $id_users)->first()->id;

        $vehiculo = new Vehiculo();
        $vehiculo->placa = $request->placa;
        $vehiculo->marca = $request->marca;
        $vehiculo->modelo = $request->modelo;
        $vehiculo->color = $request->color;
        $vehiculo->observacion = $request->observa;
        $vehiculo->cliente_id = $id_clie;
        $vehiculo->save();

        return redirect()->route('vehiculos.index')
                ->with('info', 'Vehiculo creado con exito');
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
        $vehiculo = Vehiculo::where('cedula', 'LIKE', "%$request->search%");

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
        $roles = Role::get();
        return view('vehiculos.edit', compact('vehiculo', 'roles'));
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
        //$user->update($request->all());
        //actualiza usuario
        $vehiculos = Vehiculo::findOrFail($id);

        $users->cedula = $request->cedula;
        $users->name = $request->name;
        $users->apellido_pater = $request->apellido_pater;
        $users->apellido_mater = $request->apellido_mater;
        $users->direc = $request->direc;
        $users->tlf = $request->tlf;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);

        $users->save();

        //actualiza roles de ese usuario
        $users->roles()->sync($request->get('roles'));

        return redirect()->route('vehiculos.index')
                ->with('info', 'Usuario actualizado con exito');
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
