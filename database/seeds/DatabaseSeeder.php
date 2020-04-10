<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);
        //$this->call(UserSeeder::class);
        //$this->call(ClienteSeeder::class);
        //$this->call(MarcaSeeder::class);
        //$this->call(VehiculoSeeder::class);
        //$this->call(MantenimientoSeeder::class);
        //$this->call(TrabajoSeeder::class);
    }
}
