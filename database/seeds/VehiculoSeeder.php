<?php

use Illuminate\Database\Seeder;

class VehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Vehiculo::create([
            'placa' => 'CHIEF-001',
            'modelo' => 'FORTUNER 2019',
            'color' => 'Azul Marino',
            'kilometraje'   =>  '200',
            'tipo_vehiculo' => 'Todo Terreno',
            'observacion' => '9cito',
            'marca_id' => 1,
            'cliente_id' => 1,
        ]);

        App\Vehiculo::create([
            'placa' => 'HOWDOES-24',
            'modelo' => '785D',
            'color' => 'Rojo',
            'kilometraje'   =>  '12015',
            'tipo_vehiculo' => 'Camion Minero',
            'observacion' => '9cito',
            'marca_id' => 2,
            'cliente_id' => 2,
        ]);

        App\Vehiculo::create([
            'placa' => 'HOWDOES-25',
            'modelo' => '785D',
            'color' => 'Negro',
            'kilometraje'   =>  '6523',
            'tipo_vehiculo' => 'Camion Minero',
            'observacion' => '9cito',
            'marca_id' => 3,
            'cliente_id' => 1,
        ]);

        App\Vehiculo::create([
            'placa' => 'HOWDOES-26',
            'modelo' => '785D',
            'color' => 'Blanco',
            'kilometraje'   =>  '98542',
            'tipo_vehiculo' => 'Camion Minero',
            'observacion' => '9cito',
            'marca_id' => 4,
            'cliente_id' => 2,
        ]);
    }
}
