<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item_doado extends Model
{
    public function materiais_coletados()
    {
        return $this->hasMany(Materiais_coletado::class);
    }
}
