<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    public function instituicoes()
    {
        return $this->hasMany(Instituicao::class);
    }

    public function materiais_coletados()
    {
        return $this->hasMany(Materiais_coletado::class);
    }
}
