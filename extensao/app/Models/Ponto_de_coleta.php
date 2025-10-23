<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ponto_de_coleta extends Model
{
    public function instituicoes()
    {
        return $this->hasMany(Instituicao::class);
    }
}
