<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doacao extends Model
{
    use HasFactory;

    protected $table = 'doacaos'; // ou o nome que estiver na sua migration
    protected $fillable = [
        'id_instituicao',
        'id_usuario',
        'tipo',
        'endereco_destino',
        'data_prevista_entrega',
        'status',
    ];

    public function instituicao()
    {
        return $this->belongsTo(Instituicao::class, 'id_instituicao');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function itens()
    {
        return $this->hasMany(ItensDoacao::class, 'id_doacao');
    }
}
