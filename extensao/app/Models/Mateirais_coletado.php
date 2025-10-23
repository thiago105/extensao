<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mateirais_coletado extends Model
{
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function estoque()
    {
        return $this->hasMany(Estoque::class);
    }

    public function item_doado()
    {
        return $this->hasMany(Item_doado::class);
    }
}
