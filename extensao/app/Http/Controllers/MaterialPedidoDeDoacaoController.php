<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class MaterialPedidoDeDoacaoController extends Controller
{
    use HasFactory;

    // Nome da tabela como no seu esquema
    protected $table = 'material_pedido_de_doacao';

    // Campos que podem ser preenchidos
    protected $fillable = [
        'pedido_de_doacao_id',
        'material_id',
        'quantidade',
    ];

    // Seu esquema não mostra 'timestamps' (created_at/updated_at)
    // nesta tabela, então vamos desativá-los.
    public $timestamps = false;
}
