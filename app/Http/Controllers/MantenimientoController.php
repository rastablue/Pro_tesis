<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Mantenimiento;
use App\Trabajo;
use App\User;

class MantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mantenimiento = Mantenimiento::paginate(8);

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
        Mantenimiento::create([
            'cedula' => $request['cedula'],
            'name' => $request['name'],
            'apellido_pater' => $request['apellido_pater'],
            'apellido_mater' => $request['apellido_mater'],
            'direc' => $request['direc'],
            'tlf' => $request['tlf'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->route('users.index')
                ->with('info', 'Usuario creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mantenimiento  mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Mantenimiento $mantenimiento)
    {
        $trabajo = Mantenimiento::findOrFail($mantenimiento->id)->trabajos->first();
        $empleado = Trabajo::findOrFail($trabajo->id)->where('id', $trabajo->empleado_id);
        $user = User::get()->where('id', $empleado);

        return view('mantenimientos.show', compact('mantenimiento', 'user'));
    }

    public function search(Request $request)
    {
        $mantenimiento = Mantenimiento::where('cedula', 'LIKE', "%$request->search%");

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
        $roles = Role::get();
        return view('mantenimientos.edit', compact('mantenimiento', 'roles'));
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
        $users = User::findOrFail($id);

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
        $mantenimientos->roles()->sync($request->get('roles'));

        return redirect()->route('mantenimientos.index')
                ->with('info', 'Usuario actualizado con exito');
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
