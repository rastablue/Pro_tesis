<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarcaVehiculo extends Model
{
    public function vehiculos(){
        return $this->hasMany(Vehiculo::class);
    }

    protected $fillable = [
        'marca',
    ];
}
