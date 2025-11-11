<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    protected $casts = [
        'concluido' => 'boolean',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
