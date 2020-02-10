<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class);
    }

    public function users()
    {
        return $this->hasOne(User::class);
    }
}
