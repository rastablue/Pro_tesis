<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::all();
        return view('empleados.index', compact('empleados'));
    }

    public function empleadoData()
    {
        $usuarios = User::all();

        return Datatables()
                ->eloquent(Empleado::query())
                /*->addColumn('btn', function($vehiculos){
                    return '<button type="button" class="btn btn-warning btn-sm" id="getEditProductData" data-id="'.$vehiculos->id.'">Edit</button>
                    <button type="button" data-id="'.$vehiculos->id.'" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';

                })*/
                ->addColumn('empleados_ced', function($usuarios){
                    return $usuarios->users->cedula;
                })
                ->addColumn('empleados_name', function($usuarios){
                    return $usuarios->users->name;
                })
                ->addColumn('empleados_ape', function($usuarios){
                    return $usuarios->users->apellido_pater;
                })
                ->addColumn('empleados_tlf', function($usuarios){
                    return $usuarios->users->tlf;
                })
                ->addColumn('empleados_email', function($usuarios){
                    return $usuarios->users->email;
                })
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::where('cedula', $request->cedula)->first();

        if ($user) {

            if ($aaa = Empleado::where('user_id', $user->id)->first()){
                return redirect()->route('empleados.index')
                    ->with('danger', 'Error, el usuario ya es empleado');
            }else {
                    $empleado = New Empleado();
                    $empleado->user_id = $user->id;
                    $empleado->save();
                    return redirect()->route('empleados.index')
                        ->with('info', 'Empleado agregado con exito');
                }

        }else{
            return back()->with('danger', 'Error, el Usuario no existe');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    public function search(Request $request)
    {
        $empleado = User::where('id', 'LIKE', "%$request->search%")->get();
        return view('empleados.search', compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
        return view('empleados.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        $empleado->update($request->all());

        return redirect()->route('empleados.index')
                ->with('info', 'Empleado Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        //
    }
}
