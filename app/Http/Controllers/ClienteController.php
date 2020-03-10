<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Cliente;
use App\User;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    public function clienteData()
    {
        $usuarios = Cliente::all();

        return Datatables()
                ->eloquent(Cliente::query())
                /*->addColumn('btn', function($vehiculos){
                    return '<button type="button" class="btn btn-warning btn-sm" id="getEditProductData" data-id="'.$vehiculos->id.'">Edit</button>
                    <button type="button" data-id="'.$vehiculos->id.'" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';

                })*/
                ->addColumn('clientes_ced', function($usuarios){
                    return $usuarios->users->cedula;
                })
                ->addColumn('clientes_name', function($usuarios){
                    return $usuarios->users->name;
                })
                ->addColumn('clientes_ape', function($usuarios){
                    return $usuarios->users->apellido_pater;
                })
                ->addColumn('clientes_tlf', function($usuarios){
                    return $usuarios->users->tlf;
                })
                ->addColumn('clientes_email', function($usuarios){
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
        return view('clientes.create');
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

            if ($aaa = Cliente::where('user_id', $user->id)->first()){
                return redirect()->route('clientes.index')
                    ->with('info', 'El usuario ya es cliente');
            }else {
                    $cliente = New Cliente();
                    $cliente->user_id = $user->id;
                    $cliente->save();
                    return redirect()->route('clientes.index')
                        ->with('info', 'Cliente agregado con exito');
                }
            }

        else{
            return back()->with('info', 'El Usuario no existe');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    public function search(Request $request)
    {
        $user = User::where('cedula', 'LIKE', "%$request->search%");
        return view('clientes.search', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
