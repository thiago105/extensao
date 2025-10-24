<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class materiais extends Model
{
    public function materiais_coletados()
    {
        return $this->hasMany(Materiais_coletado::class);
    }

    public function ponto_de_coleta()
    {
        return $this->hasMany(Ponto_de_coleta::class);
    }
}
