<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{

    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class);
    }

    public function clientes()
    {
        return $this->belongsTo(Cliente::class);
    }
}
