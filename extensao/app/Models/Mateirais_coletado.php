<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mateirais_coletado extends Model
{
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
