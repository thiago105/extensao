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
}
