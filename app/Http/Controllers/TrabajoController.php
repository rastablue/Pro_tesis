<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Trabajo;
use App\Mantenimiento;
use App\User;
use App\Empleado;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTrabajo;
use App\Http\Requests\EditTrabajo;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Vinkla\Hashids\Facades\Hashids;
use Barryvdh\DomPDF\Facade as PDF;

class TrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trabajos = Trabajo::paginate(5);
        return view('trabajos.index', compact('trabajos'));
    }

    public function trabajoData()
    {
        $consultas = Trabajo::all();

        return Datatables()
                ->eloquent(Trabajo::query())
                ->addColumn('nro_ficha', function($consultas){
                    return $consultas->mantenimientos->nro_ficha;
                })
                ->addColumn('placa', function($consultas){
                    if ($consultas->mantenimientos->vehiculo_id) {
                        return $consultas->mantenimientos->vehiculos->placa;
                    } else {
                        return 'N/A';
                    }
                })
                ->addColumn('empleados', function($consultas){
                    if ($consultas->user_id) {
                        return $consultas->users->name.' '.$consultas->users->apellido_pater;
                    } else {
                        return 'N/A';
                    }
                })
                ->addColumn('btn', 'trabajos.actions')
                ->rawColumns(['btn'])
                ->make(true);
    }

    public function reportes()
    {
        /**
         * toma en cuenta que para ver los mismos
         * datos debemos hacer la misma consulta
        **/
        $trabajo = Trabajo::all();

        $pdf = PDF::loadView('pdfs.reporte-trabajos', compact('trabajo'));

        return $pdf->download('reporte-trabajos.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTrabajo $request)
    {
        $user = User::where('cedula', $request->cedula)->first();
        $mantenimiento = Mantenimiento::findOrFail($request->id_mantenimiento);

        if ($mantenimiento->estado == 'Finalizado') {

            return redirect()->route('mantenimientos.show', Hashids::encode($mantenimiento->id))
                    ->with('danger', 'Este mantenimiento ya ha finalizado, no es posible agregar mas trabajos');

        } else {
            if ($request->costo_de_repuestos < 0) {
                $request->costo_de_repuestos = $request->costo_de_repuestos * -1;
            }

            if ($request->costo_mano_de_obra < 0) {
                $request->costo_mano_de_obra = $request->costo_mano_de_obra * -1;
            }

            $trabajo = new Trabajo();
            $trabajo->fake_id = Str::random(5);
            $trabajo->manobra = $request->mano_de_obra;
            $trabajo->repuestos = $request->repuestos;
            $trabajo->costo_repuestos = $request->costo_de_repuestos;
            $trabajo->costo_manobra = $request->costo_mano_de_obra;
            $trabajo->estado = $request->estado;
            $trabajo->tipo = $request->tipo;
            $trabajo->mantenimiento_id = $request->id_mantenimiento;
            $trabajo->user_id = $user->id;

            $trabajo->save();

            $valorTotal = $request->costo_de_repuestos + $request->costo_mano_de_obra + $mantenimiento->valor_total;

            $mantenimiento->valor_total = $valorTotal;

            //Si el estado del trabajo es 'Activo' el mantenimiento pasara a estar activo automaticamente
            if($request->estado == 'Activo'){
                $mantenimiento->estado = 'Activo';
            }

            $mantenimiento->save();

            return redirect()->route('mantenimientos.show', Hashids::encode($request->id_mantenimiento))
                    ->with('info', 'Trabajo creado');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trabajo  $trabajo
     * @return \Illuminate\Http\Response
     */

    public function show($mantenimiento)
    {
        $id = Hashids::decode($mantenimiento);
        $mantenimiento = Mantenimiento::findOrFail($id)->first();
        return view('trabajos.create', compact('mantenimiento'));
    }

    public function pendientes($id)
    {
        if ($empleado = User::findOrFail($id)->empleados) {
            $empleado = User::findOrFail($id)->empleados->id;

            $trabajos = Trabajo::where('empleado_id', $empleado)->get();

            return view('trabajos.show', compact('trabajos'));

        } else {

            return abort(503);

        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trabajo  $trabajo
     * @return \Illuminate\Http\Response
     */
    public function edit($trabajo)
    {
        $id = Hashids::decode($trabajo);
        $trabajo = Trabajo::findOrFail($id)->first();
        $mantenimiento = Mantenimiento::where('id', $trabajo->mantenimiento_id)->first();

        if ($trabajo->estado == 'Finalizado') {
            return back()->with('danger', 'Error, el trabajo ya no puede actualizarse');
        } else {
            return view('trabajos.edit', compact('trabajo', 'mantenimiento'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trabajo  $trabajo
     * @return \Illuminate\Http\Response
     */
    public function update(EditTrabajo $request, $trabajo)
    {
        $trabajos = Trabajo::findOrFail($trabajo);
        $mantenimiento = Mantenimiento::findOrFail($request->id_mante);
        $id_users = User::where('cedula', $request->cedula)->first()->id;

        if ($mantenimiento->estado != 'Finalizado') {
            //Revisa si los valores de precios ingresados son negativos, en caso de serlo se convierten a positivo
                if ($request->costo_de_repuestos < 0) {
                    $request->costo_de_repuestos = $request->costo_de_repuestos * -1;
                }

                if ($request->costo_mano_de_obra < 0) {
                    $request->costo_mano_de_obra = $request->costo_mano_de_obra * -1;
                }

            //Resta los antiuguos valores del trabajo de su respectivo mantenimiento
                $valorResta = $mantenimiento->valor_total - $trabajos->costo_repuestos - $trabajos->costo_manobra;
                $mantenimiento->valor_total = $valorResta;
                $mantenimiento->save();

            //Actualiza los datos del trabajo
                $trabajos->manobra = $request->mano_de_obra;
                $trabajos->repuestos = $request->repuestos;
                $trabajos->costo_repuestos = $request->costo_de_repuestos;
                $trabajos->costo_manobra = $request->costo_mano_de_obra;
                $trabajos->estado = $request->estado;
                $trabajos->tipo = $request->tipo;
                $trabajos->user_id = $id_users;

                $trabajos->save();

            //Actualiza el valor total del mantenimiento respectivo al trabajo
                $valorTotal = $request->costo_de_repuestos + $request->costo_mano_de_obra + $mantenimiento->valor_total;

                $mantenimiento->valor_total = $valorTotal;
                $mantenimiento->save();

                return redirect()->route('mantenimientos.show', Hashids::encode($request->id_mante))
                    ->with('info', 'Trabajo actualizado');

        } else {
            return redirect()->route('mantenimientos.show', Hashids::encode($mantenimiento->id))
                    ->with('danger', 'Este mantenimiento ha finalizado, por lo que no es posible actualizar su informacion');
        }

    }

    public function finalizar(request $request, $id)
    {
        $trabajo = Trabajo::findOrFail($id);

        if ($trabajo->estado != 'Finalizado') {

            $trabajo->estado = 'Finalizado';

            $trabajo->save();

        }
    }

    public function finalizarFrom($id)
    {
        $trabajo = Trabajo::findOrFail($id);

        if ($trabajo->estado != 'Finalizado') {

            $trabajo->estado = 'Finalizado';

            $trabajo->save();

            return back()->with('info', 'Trabajo finalizado adecuadamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trabajo  $trabajo
     * @return \Illuminate\Http\Response
     */
    public function destroy($trabajo)
    {
        $id = Trabajo::findOrFail($trabajo);

        $mantenimiento = Mantenimiento::findOrFail($id->mantenimientos->id);

        $valorTotal = $mantenimiento->valor_total - $id->costo_manobra - $id->costo_repuestos;
        $mantenimiento->valor_total = $valorTotal;
        $mantenimiento->save();

        $id->delete();
    }
}
