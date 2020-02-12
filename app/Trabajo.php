<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    public function empleados()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    public function mantenimientos()
    {
        return $this->belongsTo(Mantenimiento::class);
    }
}
