<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = role::paginate(5);

        return view('roles.index', compact('role'));
    }

    public function roleData()
    {
        $permissions = Permission::get();

        return Datatables()
                ->eloquent(Role::query())
                ->addColumn('permissions', function($permissions){
                    return $permissions;
                })
                /*->addColumn('btn', function($vehiculos){
                    return '<button type="button" class="btn btn-warning btn-sm" id="getEditProductData" data-id="'.$vehiculos->id.'">Edit</button>
                    <button type="button" data-id="'.$vehiculos->id.'" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';

                })*/
                ->addColumn('btn', 'roles.actions')
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
        $permissions = Permission::get();

        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->name == '') {

            return redirect()->route('roles.index')
                ->with('info', 'No se ingreso un nombre');

        } else {

            if ($request->slug == '') {

                return redirect()->route('roles.index')
                    ->with('info', 'No se ingreso un slug');

            } else {

                if ($request->description == '') {

                    return redirect()->route('roles.index')
                        ->with('info', 'No se ingreso una descripcion');

                } else {

                    $role = Role::create($request->all());

                    $role->permissions()->sync($request->get('permissions'));

                    return redirect()->route('roles.index')
                            ->with('info', 'Role creado con exito');

                }

            }

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $permissions = Permission::get();

        return view('roles.show', compact('role', 'permissions'));
    }

    public function search(Request $request)
    {

        $role = Role::where('name', 'LIKE', "%$request->search%");

        return view('roles.search', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::get();

        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //$role->update($request->all());
        //actualiza role
        $role->update($request->all());

        //actualiza permisos
        $role->permissions()->sync($request->get('permissions'));

        return redirect()->route('roles.index')
                ->with('info', 'Role actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
    }
}
