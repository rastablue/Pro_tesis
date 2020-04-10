<?php

use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Marca::create([
            'marca' => 'Sin Marca'
        ]);

        App\Marca::create([
            'marca' => 'Toyota'
        ]);

        App\Marca::create([
            'marca' => 'Chevrolet'
        ]);

        App\Marca::create([
            'marca' => 'Jepp'
        ]);

        App\Marca::create([
            'marca' => 'Mercedes'
        ]);

        App\Marca::create([
            'marca' => 'Nissan'
        ]);

        App\Marca::create([
            'marca' => 'Suzuki'
        ]);

        App\Marca::create([
            'marca' => 'Fiat'
        ]);

        App\Marca::create([
            'marca' => 'Ford'
        ]);

        App\Marca::create([
            'marca' => 'Mazda'
        ]);

        App\Marca::create([
            'marca' => 'Chery'
        ]);

        App\Marca::create([
            'marca' => 'Audi'
        ]);

        App\Marca::create([
            'marca' => 'China Motors'
        ]);

        App\Marca::create([
            'marca' => 'Citroën'
        ]);

        App\Marca::create([
            'marca' => 'Daewoo'
        ]);

        App\Marca::create([
            'marca' => 'Peugeot'
        ]);

        App\Marca::create([
            'marca' => 'BMW'
        ]);
    }
}
