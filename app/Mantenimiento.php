<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{

    public function trabajos()
    {
        return $this->hasMany(Trabajo::class);
    }

    public function vehiculos()
    {
        return $this->belongsTo(Vehiculo::class);
    }
}
