<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Validator;
use Caffeinated\Shinobi\Models\Role;
use App\User;
use App\Empleado;
use App\Cliente;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::paginate(5);

        return view('users.index', compact('user'));
    }

    public function userData()
    {

        return Datatables()
                ->eloquent(User::query())
                ->addColumn('btn', 'users.actions')
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
        $ced = $request->cedula;

        if ($id_users = User::where('cedula', $ced)->first()) {
            return back() ->with('danger', 'Error, el Usuario ya existe');
        } else {
            if ($id_users = User::where('email', $request->email)->first()) {
                return back() ->with('danger', 'Error, el Correo ya existe');
            } else {
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
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        $id = Hashids::decode($user);
        $user = User::findOrfail($id)->first();
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        $id = Hashids::decode($user);
        $user = User::findOrfail($id)->first();
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

        if ($id_users = User::where('email', $request->email)->first()) {
            return redirect()->route('users.index')
                ->with('danger', 'Error, el Correo ya existe');
        } else {

            $users = User::findOrFail($id);

            $users->name = $request->name;
            $users->apellido_pater = $request->apellido_pater;
            $users->apellido_mater = $request->apellido_mater;
            $users->direc = $request->direc;
            $users->tlf = $request->tlf;

            $users->save();
            //actualiza roles de ese usuario
            $users->roles()->sync($request->get('roles'));

            if($request->get('roles') == 3){
                if ($users->roles()->sync($request->get('roles'))){
                    return redirect()->route('users.index')
                        ->with('info', 'Usuario actualizado con exito');
                }
                else {
                    $cliente = New Cliente();
                    $cliente->user_id = $id;
                    $cliente->save();
                    return redirect()->route('users.index')
                        ->with('info', 'Usuario actualizado con exito');
                }
            }else{
                if($request->get('roles') == 4){
                    if ($aaa = Empleado::where('user_id', $id)->first()){
                        return redirect()->route('users.index')
                            ->with('info', 'Usuario actualizado con exito');
                    }
                    else {
                        $empleado = New Empleado();
                        $empleado->user_id = $id;
                        $empleado->save();
                        return redirect()->route('users.index')
                            ->with('info', 'Usuario actualizado con exito');
                    }
                }

                if ($request->get('roles') == 1) {
                    return redirect()->route('users.index')
                            ->with('info', 'Administrador actualizado con exito');
                }else{
                    return redirect()->route('users.index')
                            ->with('info', 'Usuario actualizado con exito');
                }
            }
        }
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
    }
}
