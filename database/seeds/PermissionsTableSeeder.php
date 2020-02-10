<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Users

        Permission::create([
            'name'  =>  'Navegar usuarios',
            'slug'  =>  'users.index',
            'description'  =>  'Lista y navega todos los usuarios del sistema',
        ]);

        Permission::create([
            'name'  =>  'Ver detalle de usuario',
            'slug'  =>  'users.show',
            'description'  =>  'Ver en detalle cada usuario del sistema',
        ]);

        Permission::create([
            'name'  =>  'Creacion de usuarios',
            'slug'  =>  'users.create',
            'description'   =>  'Crea usuarios en el sistema',
        ]);

        Permission::create([
            'name'  =>  'Edicion de usuarios',
            'slug'  =>  'users.edit',
            'description'  =>  'Editar cualquier dato de un usuario del sistema',
        ]);

        Permission::create([
            'name'  =>  'Eliminar usuarios',
            'slug'  =>  'users.destroy',
            'description'  =>  'Eliminar cualquier usuario del sistema',
        ]);

        //Roles

        Permission::create([
            'name'  =>  'Navegar roles',
            'slug'  =>  'roles.index',
            'description'   =>  'Lista y navega todos los roles del sistema',
        ]);

        Permission::create([
            'name'  =>  'Ver detalle de rol',
            'slug'  =>  'roles.show',
            'description'   =>  'Ver en detalle cada rol del sistema',
        ]);

        Permission::create([
            'name'  =>  'Creacion de roles',
            'slug'  =>  'roles.create',
            'description'   =>  'Crea roles de un usuario del sistema',
        ]);

        Permission::create([
            'name'  =>  'Editar roles',
            'slug'  =>  'roles.edit',
            'description'   =>  'Edita roles del sistema',
        ]);

        Permission::create([
            'name'  =>  'Eliminar roles',
            'slug'  =>  'roles.destroy',
            'description'   =>  'Eliminar rol del sistema',
        ]);

        //Vehiculos

        Permission::create([
            'name'  =>  'Navegar vehiculos',
            'slug'  =>  'vehiculos.index',
            'description'   =>  'Lista y navega todos los vehiculos del sistema',
        ]);

        Permission::create([
            'name'  =>  'Ver detalle de vehiculo',
            'slug'  =>  'vehiculos.show',
            'description'   =>  'Ver en detalle cada vehiculo del sistema',
        ]);

        Permission::create([
            'name'  =>  'Creacion de vehiculos',
            'slug'  =>  'vehiculos.create',
            'description'   =>  'Crea vehiculos en el sistema',
        ]);

        Permission::create([
            'name'  =>  'Editar vehiculos',
            'slug'  =>  'vehiculos.edit',
            'description'   =>  'Edita vehiculos del sistema',
        ]);

        Permission::create([
            'name'  =>  'Eliminar vehiculos',
            'slug'  =>  'vehiculos.destroy',
            'description'   =>  'Eliminar vehiculos del sistema',
        ]);

        //Mantenimientos

        Permission::create([
            'name'  =>  'Navegar mantenimientos',
            'slug'  =>  'mantenimientos.index',
            'description'   =>  'Lista y navega todos los mantenimientos del sistema',
        ]);

        Permission::create([
            'name'  =>  'Ver detalle de mantenimiento',
            'slug'  =>  'mantenimientos.show',
            'description'   =>  'Ver en detalle cada mantenimiento del sistema',
        ]);

        Permission::create([
            'name'  =>  'Creacion de mantenimientos',
            'slug'  =>  'mantenimientos.create',
            'description'   =>  'Crea mantenimientos del sistema',
        ]);

        Permission::create([
            'name'  =>  'Editar mantenimientos',
            'slug'  =>  'mantenimientos.edit',
            'description'   =>  'Edita mantenimientos del sistema',
        ]);

        Permission::create([
            'name'  =>  'Eliminar mantenimientos',
            'slug'  =>  'mantenimientos.destroy',
            'description'   =>  'Eliminar mantenimientos del sistema',
        ]);

        //Trabajos

        Permission::create([
            'name'  =>  'Navegar trabajos',
            'slug'  =>  'trabajos.index',
            'description'   =>  'Lista y navega todos los trabajos del sistema',
        ]);

        Permission::create([
            'name'  =>  'Ver detalle de trabajos',
            'slug'  =>  'trabajos.show',
            'description'   =>  'Ver en detalle cada trabajo del sistema',
        ]);

        Permission::create([
            'name'  =>  'Creacion de trabajos',
            'slug'  =>  'trabajos.create',
            'description'   =>  'Crea trabajos de un mantenimiento del sistema',
        ]);

        Permission::create([
            'name'  =>  'Editar trabajos',
            'slug'  =>  'trabajos.edit',
            'description'   =>  'Edita trabajos del sistema',
        ]);

        Permission::create([
            'name'  =>  'Eliminar trabajos',
            'slug'  =>  'trabajos.destroy',
            'description'   =>  'Eliminar trabajo del sistema',
        ]);
    }
}
