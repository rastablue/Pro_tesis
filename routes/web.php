<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function(){

    //Roles

        Route::post('roles/store', 'RoleController@store')->name('roles.store')
                    ->middleware('can:roles.create');

        Route::get('roles', 'RoleController@index')->name('roles.index')
                    ->middleware('can:roles.index');

        Route::get('get-roles', 'RoleController@roleData')->name('datatables.roles')
                    ->middleware('can:roles.index');

        Route::get('roles/create', 'RoleController@create')->name('roles.create')
                    ->middleware('can:roles.create');

        Route::put('roles/{role}', 'RoleController@update')->name('roles.update')
                    ->middleware('can:roles.edit');

        Route::get('roles/{role}', 'RoleController@show')->name('roles.show')
                    ->middleware('can:roles.show');

        Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')
                    ->middleware('can:roles.destroy');

        Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')
                    ->middleware('can:roles.edit');

    //Users

        Route::get('descargar-users', 'UserController@reportes')->name('users.reportes')
                    ->middleware('can:users.show');

        Route::post('users/store', 'UserController@store')->name('users.store')
                    ->middleware('can:users.create');

        Route::get('users', 'UserController@index')->name('users.index')
                    ->middleware('can:users.index');

        Route::get('get-users', 'UserController@userData')->name('datatables.users')
                    ->middleware('can:users.index');

        Route::get('users/create', 'UserController@create')->name('users.create')
                    ->middleware('can:users.create');

        Route::put('users/{user}', 'UserController@update')->name('users.update')
                    ->middleware('can:users.edit');

        Route::put('update/{user}', 'UserController@updatepass')->name('pass.update');

        Route::get('users/{user}', 'UserController@show')->name('users.show')
                    ->middleware('can:users.show');

        Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy')
                    ->middleware('can:users.destroy');

        Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit')
                    ->middleware('can:users.edit');

        Route::get('users/{user}/edita', 'UserController@edita')->name('users.edita')
                    ->middleware('can:users.edit');

        Route::get('profile/{user}', 'UserController@updateProfile')->name('profile.edit');

    //Clientes

        Route::get('descargar-clientes', 'ClienteController@reportes')->name('clientes.reportes')
                    ->middleware('can:clientes.show');

        Route::get('descargar-clientes/{cliente}', 'ClienteController@pdf')->name('clientes.pdf');

        Route::post('clientes/store', 'ClienteController@store')->name('clientes.store')
                    ->middleware('can:clientes.create');

        Route::get('clientes', 'ClienteController@index')->name('clientes.index')
                    ->middleware('can:clientes.index');

        Route::get('get-clientes', 'ClienteController@clienteData')->name('datatables.clientes')
                   ->middleware('can:clientes.index');

        Route::get('clientes/create', 'ClienteController@create')->name('clientes.create')
                    ->middleware('can:clientes.create');

        Route::put('clientes/{user}', 'ClienteController@update')->name('clientes.update')
                    ->middleware('can:clientes.edit');

        Route::get('clientes/{user}', 'ClienteController@show')->name('clientes.show')
                    ->middleware('can:clientes.show');

        Route::delete('clientes/{user}', 'ClienteController@destroy')->name('clientes.destroy')
                    ->middleware('can:clientes.destroy');

        Route::get('clientes/{user}/edit', 'ClienteController@edit')->name('clientes.edit')
                    ->middleware('can:clientes.edit');

    //Empleados

        Route::post('empleados/store', 'EmpleadoController@store')->name('empleados.store')
                    ->middleware('can:empleados.create');

        Route::get('empleados', 'EmpleadoController@index')->name('empleados.index')
                    ->middleware('can:Empleados.index');

        Route::get('get-empleados', 'EmpleadoController@empleadoData')->name('datatables.empleados')
                   ->middleware('can:empleados.index');

        Route::get('empleados/create', 'EmpleadoController@create')->name('empleados.create')
                    ->middleware('can:empleados.create');

        Route::put('empleados/{user}', 'EmpleadoController@update')->name('empleados.update')
                    ->middleware('can:empleados.edit');

        Route::get('empleados/{user}', 'EmpleadoController@show')->name('empleados.show')
                    ->middleware('can:empleados.show');

        Route::delete('empleados/{user}', 'EmpleadoController@destroy')->name('empleados.destroy')
                    ->middleware('can:empleados.destroy');

        Route::get('empleados/{user}/edit', 'EmpleadoController@edit')->name('empleados.edit')
                    ->middleware('can:empleados.edit');

    //Mantenimientos
        //PDFs
            Route::get('descargar-mantenimientos', 'MantenimientoController@reportes')->name('mantenimientos.reportes')
                        ->middleware('can:mantenimientos.show');

            Route::get('descargar-mantenimientos/Espera', 'MantenimientoController@reportesEspera')->name('mantenimientos.reportesespera')
                            ->middleware('can:mantenimientos.show');

            Route::get('descargar-mantenimientos/inactivo', 'MantenimientoController@reportesInactivo')->name('mantenimientos.reportesinactivo')
                            ->middleware('can:mantenimientos.show');

            Route::get('descargar-mantenimientos/activo', 'MantenimientoController@reportesActivo')->name('mantenimientos.reportesactivo')
                            ->middleware('can:mantenimientos.show');

            Route::get('descargar-mantenimientos/finalizado', 'MantenimientoController@reportesFinalizado')->name('mantenimientos.reportesfinalizado')
                            ->middleware('can:mantenimientos.show');

            Route::get('seleccionar-mantenimientos', 'MantenimientoController@reportesSelect')->name('mantenimientos.reporteselect')
                            ->middleware('can:mantenimientos.show');

            Route::get('seleccionar-mantenimientos/apply', 'MantenimientoController@reportesSelectApply')->name('mantenimientos.reporteselectapply')
                            ->middleware('can:mantenimientos.show');

            Route::get('descargar-mantenimientos/{mantenimiento}', 'MantenimientoController@pdf')->name('mantenimientos.pdf');

        //Fin PDFs seccion
        Route::post('mantenimientos/store', 'MantenimientoController@store')->name('mantenimientos.store')
                    ->middleware('can:mantenimientos.create');

        Route::post('mantenimientos/storefromvehiculos', 'MantenimientoController@storeFromVehiculo')->name('mantenimientos.storefromvehiculos')
                    ->middleware('can:mantenimientos.create');

        Route::get('mantenimientos', 'MantenimientoController@index')->name('mantenimientos.index')
                    ->middleware('can:mantenimientos.index');

        Route::get('get-mantenimientos', 'MantenimientoController@mantenimientoData')->name('datatables.mantenimientos')
                    ->middleware('can:mantenimientos.index');

        Route::get('mantenimientos/create', 'MantenimientoController@create')->name('mantenimientos.create')
                    ->middleware('can:mantenimientos.create');

        Route::get('mantenimientos/createfromvehiculo/{vehiculo}', 'MantenimientoController@createFromVehiculo')->name('mantenimientos.createfromvehiculos')
                    ->middleware('can:mantenimientos.create');

        Route::put('mantenimientos/{mantenimiento}', 'MantenimientoController@update')->name('mantenimientos.update')
                    ->middleware('can:mantenimientos.edit');

        Route::get('mantenimientos/{mantenimiento}', 'MantenimientoController@show')->name('mantenimientos.show')
                    ->middleware('can:mantenimientos.show');

        Route::get('mantenimientos/fichas/{mantenimiento}', 'MantenimientoController@ficha')->name('mantenimientos.ficha')
                    ->middleware('can:fichas.show');

        Route::delete('mantenimientos/{mantenimiento}', 'MantenimientoController@destroy')->name('mantenimientos.destroy')
                    ->middleware('can:mantenimientos.destroy');

        Route::get('mantenimientos/{mantenimiento}/edit', 'MantenimientoController@edit')->name('mantenimientos.edit')
                    ->middleware('can:mantenimientos.edit');

        ///Modificar estados de Mantenimientos
        Route::put('mantenimientos/activo/{mantenimiento}', 'MantenimientoController@activo')->name('mantenimientos.activo')
                    ->middleware('can:mantenimientos.edit');

        Route::put('mantenimientos/espera/{mantenimiento}', 'MantenimientoController@espera')->name('mantenimientos.espera')
                    ->middleware('can:mantenimientos.edit');

        Route::put('mantenimientos/inactivo/{mantenimiento}', 'MantenimientoController@inactivo')->name('mantenimientos.inactivo')
                    ->middleware('can:mantenimientos.edit');

        Route::put('mantenimientos/finalizar/{mantenimiento}', 'MantenimientoController@finalizar')->name('mantenimientos.finalizar')
                    ->middleware('can:mantenimientos.edit');

        //Marca un mantenimiento como finalizado y/o agregar imagen directamente desde la vista show
        Route::put('mantenimientos/finalizarfrom/{mantenimiento}', 'MantenimientoController@finalizarFrom')->name('mantenimientos.finalizarfrom')
                    ->middleware('can:mantenimientos.edit');

        Route::put('mantenimientos/update-foto/{mantenimiento}', 'MantenimientoController@updateFoto')->name('mantenimientos.updateFoto')
                    ->middleware('can:mantenimientos.edit');

        //Agregados si no existen
        Route::get('mantenimientos/confirmacliente/clienteconfirmado', 'MantenimientoController@confirmaCliente')->name('mantenimientos.confirmaCliente')
                    ->middleware('can:mantenimientos.create');
        
        Route::post('mantenimientos/clientestore/almacenarcliente', 'MantenimientoController@clienteStore')->name('mantenimientos.clientestore')
                    ->middleware('can:mantenimientos.create');

        Route::get('mantenimientos/confirmavehiculo/vehiculoconfirmado', 'MantenimientoController@confirmaVehiculo')->name('mantenimientos.confirmaVehiculo')
                    ->middleware('can:mantenimientos.create');
        
        Route::post('mantenimientos/vehiculostore/almacenarvehiculo', 'MantenimientoController@vehiculoStore')->name('mantenimientos.vehiculoStore')
                    ->middleware('can:mantenimientos.create');

        Route::get('mantenimientos/confirma-ambos/ambos-confirmado', 'MantenimientoController@confirmaAmbos')->name('mantenimientos.confirmaAmbos')
                    ->middleware('can:mantenimientos.create');
        
        Route::post('mantenimientos/ambos-store/almacenar-ambos', 'MantenimientoController@amboStore')->name('mantenimientos.ambosStore')
                    ->middleware('can:mantenimientos.create');

    //Vehiculos

        Route::get('descargar-vehiculos', 'VehiculoController@reportes')->name('vehiculos.reportes')
                    ->middleware('can:vehiculos.show');

        Route::get('descargar-vehiculos/{vehiculo}', 'VehiculoController@pdf')->name('vehiculos.pdf');

        Route::post('vehiculos/store', 'VehiculoController@store')->name('vehiculos.store')
                    ->middleware('can:vehiculos.create');

        Route::post('vehiculos/storefromcliente', 'VehiculoController@storefromcliente')->name('vehiculos.storefromcliente')
                    ->middleware('can:vehiculos.create');

        Route::get('vehiculos', 'VehiculoController@index')->name('vehiculos.index')
                    ->middleware('can:vehiculos.index');

        Route::get('get-vehiculos', 'VehiculoController@vehiculoData')->name('datatables.vehiculo')
                    ->middleware('can:vehiculos.index');

        Route::get('vehiculos/create', 'VehiculoController@create')->name('vehiculos.create')
                    ->middleware('can:vehiculos.create');

        Route::get('vehiculos/createfromcliente/{cliente}', 'VehiculoController@createfromcliente')->name('vehiculos.createfromcliente')
                    ->middleware('can:vehiculos.create');

        Route::put('vehiculos/{vehiculo}', 'VehiculoController@update')->name('vehiculos.update')
                    ->middleware('can:vehiculos.edit');

        Route::get('vehiculos/{vehiculo}', 'VehiculoController@show')->name('vehiculos.show')
                    ->middleware('can:vehiculos.show');

        Route::delete('vehiculos/{vehiculo}', 'VehiculoController@destroy')->name('vehiculos.destroy')
                    ->middleware('can:vehiculos.destroy');

        Route::get('vehiculos/{vehiculo}/edit', 'VehiculoController@edit')->name('vehiculos.edit')
                    ->middleware('can:vehiculos.edit');

        //Agregado si no existen
        Route::get('vehiculos/confirmacliente/clienteconfirmado', 'VehiculoController@confirmaCliente')->name('vehiculos.confirmaCliente')
                    ->middleware('can:vehiculos.create');
        
        Route::post('vehiculos/clientestore/almacenarcliente', 'VehiculoController@clienteStore')->name('vehiculos.clienteStore')
                    ->middleware('can:vehiculos.create');

    //Marcas

        Route::post('marcas/store', 'MarcaController@store')->name('marcas.store')
                    ->middleware('can:marcas.create');

        Route::get('marcas', 'MarcaController@index')->name('marcas.index')
                    ->middleware('can:marcas.index');

        Route::get('get-marcas', 'MarcaController@marcaData')->name('datatables.marcas')
                    ->middleware('can:marcas.index');

        Route::get('marcas/create', 'MarcaController@create')->name('marcas.create')
                    ->middleware('can:marcas.create');

        Route::put('marcas/{vehiculo}', 'MarcaController@update')->name('marcas.update')
                    ->middleware('can:marcas.edit');

        Route::get('marcas/{vehiculo}', 'VehiculoController@show')->name('marcas.show')
                    ->middleware('can:marcas.show');

        Route::delete('marcas/{vehiculo}', 'MarcaController@destroy')->name('marcas.destroy')
                    ->middleware('can:marcas.destroy');

        Route::get('marcas/{vehiculo}/edit', 'MarcaController@edit')->name('marcas.edit')
                    ->middleware('can:marcas.edit');

    //Trabajos

        Route::get('descargar-trabajos', 'TrabajoController@reportes')->name('trabajos.reportes')
                    ->middleware('can:trabajos.show');

        Route::post('trabajos/store', 'TrabajoController@store')->name('trabajos.store')
                    ->middleware('can:trabajos.create');

        Route::get('trabajos', 'TrabajoController@index')->name('trabajos.index')
                    ->middleware('can:trabajos.index');

        Route::get('get-trabajos', 'TrabajoController@trabajoData')->name('datatables.trabajos')
                    ->middleware('can:trabajos.index');

        Route::get('trabajos/create', 'TrabajoController@create')->name('trabajos.create')
                    ->middleware('can:trabajos.create');

        Route::put('trabajos/{trabajo}', 'TrabajoController@update')->name('trabajos.update')
                    ->middleware('can:trabajos.edit');

        Route::get('trabajos/{trabajo}', 'TrabajoController@show')->name('trabajos.show')
                    ->middleware('can:trabajos.show');

        Route::get('trabajos/pendientes/{trabajo}', 'TrabajoController@pendientes')->name('trabajos.pendientes')
                    ->middleware('can:trabajos.show');

        Route::delete('trabajos/{trabajo}', 'TrabajoController@destroy')->name('trabajos.destroy')
                    ->middleware('can:trabajos.destroy');

        Route::get('trabajos/{trabajo}/edit', 'TrabajoController@edit')->name('trabajos.edit')
                    ->middleware('can:trabajos.edit');

        //Marca un mantenimiento como finalizado directamente
        Route::put('trabajos/finalizar/{trabajo}', 'TrabajoController@finalizar')->name('trabajos.finalizar')
                    ->middleware('can:trabajos.edit');

        //Marca un mantenimiento como finalizado directamente desde la vista show
        Route::put('trabajos/finalizarfrom/{trabajo}', 'TrabajoController@finalizarFrom')->name('trabajos.finalizarfrom')
                    ->middleware('can:trabajos.edit');

        ///Modificar estados de Trabajos
        Route::put('trabajos/activo/{trabajo}', 'TrabajoController@activo')->name('trabajos.activo')
                    ->middleware('can:trabajos.edit');

        Route::put('trabajos/espera/{trabajo}', 'TrabajoController@espera')->name('trabajos.espera')
                    ->middleware('can:trabajos.edit');

        Route::put('trabajos/inactivo/{trabajo}', 'TrabajoController@inactivo')->name('trabajos.inactivo')
                    ->middleware('can:trabajos.edit');

        Route::put('trabajos/finalizar/{trabajo}', 'TrabajoController@finalizar')->name('trabajos.finalizar')
                    ->middleware('can:trabajos.edit');
});
