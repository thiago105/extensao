<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ponto_de_coleta extends Model
{

    protected $table = 'ponto_de_coletas';

    protected $fillable = [
        'id_instituicao',
        'endereco',
        'data_inicio',
        'data_fim',
    ];

    protected $casts = [
        'data_inicio' => 'datetime',
        'data_fim' => 'datetime',
    ];

    public function instituicoes()
    {
        return $this->belongsTo(Instituicao::class, 'id_instituicao', 'id');
    }

    public function doacoes()
    {

        return $this->hasMany(Doacao_recebida::class, 'ponto_de_coleta_id', 'id');
    }
}
