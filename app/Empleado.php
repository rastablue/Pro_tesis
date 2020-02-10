<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    public function users()
    {
        return $this->hasOne(User::class);
    }

    public function trabajos()
    {
        return $this->hasMany(Trabajo::class);
    }
}
