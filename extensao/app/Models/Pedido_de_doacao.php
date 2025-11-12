<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido_de_doacao extends Model
{
    use HasFactory;

    protected $table = 'pedido_de_doacao';

    protected $fillable = [
        'usuario_id',
        'observacao',
        'endereco',
        'concluido',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function itensDoPedido()
    {
        return $this->hasMany(Material_pedido_de_doacao::class, 'pedido_de_doacao_id');
    }
}

