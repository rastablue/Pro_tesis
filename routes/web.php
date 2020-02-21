<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('users/search', 'UserController@search')->name('users.search');

Route::get('roles/search', 'RoleController@search')->name('roles.search');

Route::get('vehiculos/search', 'VehiculoController@search')->name('vehiculos.search');

Route::get('mantenimientos/search', 'mantenimientoController@search')->name('mantenimientos.search');

Route::get('empleados/search', 'empleadoController@search')->name('empleados.search');

Route::get('clientes/search', 'clienteController@search')->name('clientes.search');

Route::middleware(['auth'])->group(function(){

    //Roles

    Route::post('roles/store', 'RoleController@store')->name('roles.store')
                   ->middleware('can:roles.create');

    Route::get('roles', 'RoleController@index')->name('roles.index')
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

    Route::post('users/store', 'UserController@store')->name('users.store')
                   ->middleware('can:users.create');

    Route::get('users', 'UserController@index')->name('users.index')
                   ->middleware('can:users.index');

    Route::get('users/create', 'UserController@create')->name('users.create')
                   ->middleware('can:users.create');

    Route::put('users/{user}', 'UserController@update')->name('users.update')
                   ->middleware('can:users.edit');

    Route::get('users/{user}', 'UserController@show')->name('users.show')
                   ->middleware('can:users.show');

    Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy')
                   ->middleware('can:users.destroy');

    Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit')
                   ->middleware('can:users.edit');

    //Clientes

    Route::post('clientes/store', 'ClienteController@store')->name('clientes.store')
                   ->middleware('can:clientes.create');

    Route::get('clientes', 'ClienteController@index')->name('clientes.index')
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

    Route::post('mantenimientos/store', 'MantenimientoController@store')->name('mantenimientos.store')
                   ->middleware('can:mantenimientos.create');

    Route::get('mantenimientos', 'MantenimientoController@index')->name('mantenimientos.index')
                   ->middleware('can:mantenimientos.index');

    Route::get('mantenimientos/create', 'MantenimientoController@create')->name('mantenimientos.create')
                   ->middleware('can:mantenimientos.create');

    Route::put('mantenimientos/{mantenimiento}', 'MantenimientoController@update')->name('mantenimientos.update')
                   ->middleware('can:mantenimientos.edit');

    Route::get('mantenimientos/{mantenimiento}', 'MantenimientoController@show')->name('mantenimientos.show')
                   ->middleware('can:mantenimientos.show');

    Route::delete('mantenimientos/{mantenimiento}', 'MantenimientoController@destroy')->name('mantenimientos.destroy')
                   ->middleware('can:mantenimientos.destroy');

    Route::get('mantenimientos/{mantenimiento}/edit', 'MantenimientoController@edit')->name('mantenimientos.edit')
                   ->middleware('can:mantenimientos.edit');

    //Vehiculos

    Route::post('vehiculos/store', 'VehiculoController@store')->name('vehiculos.store')
                   ->middleware('can:vehiculos.create');

    Route::get('vehiculos', 'VehiculoController@index')->name('vehiculos.index')
                   ->middleware('can:vehiculos.index');

    Route::get('vehiculos/create', 'VehiculoController@create')->name('vehiculos.create')
                   ->middleware('can:vehiculos.create');

    Route::put('vehiculos/{vehiculo}', 'VehiculoController@update')->name('vehiculos.update')
                   ->middleware('can:vehiculos.edit');

    Route::get('vehiculos/{vehiculo}', 'VehiculoController@show')->name('vehiculos.show')
                   ->middleware('can:vehiculos.show');

    Route::delete('vehiculos/{vehiculo}', 'VehiculoController@destroy')->name('vehiculos.destroy')
                   ->middleware('can:vehiculos.destroy');

    Route::get('vehiculos/{vehiculo}/edit', 'VehiculoController@edit')->name('vehiculos.edit')
                   ->middleware('can:vehiculos.edit');

    //MarcaVehiculos

    Route::post('marcas/store', 'MarcaVehiculoController@store')->name('marcas.store')
                   ->middleware('can:marcas.create');

    Route::get('marcas', 'MarcaVehiculoController@index')->name('marcas.index')
                   ->middleware('can:marcas.index');

    Route::get('marcas/create', 'MarcaVehiculoController@create')->name('marcas.create')
                   ->middleware('can:marcas.create');

    Route::put('marcas/{vehiculo}', 'MarcaVehiculoController@update')->name('marcas.update')
                   ->middleware('can:marcas.edit');

    Route::get('marcas/{vehiculo}', 'VehiculoController@show')->name('marcas.show')
                   ->middleware('can:marcas.show');

    Route::delete('marcas/{vehiculo}', 'MarcaVehiculoController@destroy')->name('marcas.destroy')
                   ->middleware('can:marcas.destroy');

    Route::get('marcas/{vehiculo}/edit', 'MarcaVehiculoController@edit')->name('marcas.edit')
                   ->middleware('can:marcas.edit');

    //Trabajos

    Route::post('trabajos/store', 'TrabajoController@store')->name('trabajos.store')
                   ->middleware('can:trabajos.create');

    Route::get('trabajos', 'TrabajoController@index')->name('trabajos.index')
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

});
