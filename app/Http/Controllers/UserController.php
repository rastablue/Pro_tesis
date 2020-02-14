<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Caffeinated\Shinobi\Models\Role;
use App\User;
use App\Empleado;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::paginate(8);

        return view('users.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::create([
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function search(Request $request)
    {
        $user = User::where('cedula', 'LIKE', "%$request->search%");

        return view('users.search', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::get();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$user->update($request->all());
        //actualiza usuario
        $users = User::findOrFail($id);

        $users->cedula = $request->cedula;
        $users->name = $request->name;
        $users->apellido_pater = $request->apellido_pater;
        $users->apellido_mater = $request->apellido_mater;
        $users->direc = $request->direc;
        $users->tlf = $request->tlf;
        $users->email = $request->email;

        $users->save();

        //actualiza roles de ese usuario
        $users->roles()->sync($request->get('roles'));

        return redirect()->route('users.index')
                ->with('info', 'Usuario actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('info', 'Usuario eliminado');
    }
}
