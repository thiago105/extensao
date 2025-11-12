<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doacao_recebida extends Model
{
    use HasFactory;

    protected $table = 'doacao_recebida'; // ou o nome que estiver na sua migration
    protected $fillable = [
        'usuario_id',
        'ponto_de_coletas_id'
    ];

    public function ponto_de_coleta()
    {
        return $this->belongsTo(Ponto_de_coleta::class, 'ponto_de_coletas_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
