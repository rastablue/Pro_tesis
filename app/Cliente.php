<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class);
    }

}
