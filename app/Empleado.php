<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function trabajos()
    {
        return $this->hasMany(Trabajo::class);
    }
}
