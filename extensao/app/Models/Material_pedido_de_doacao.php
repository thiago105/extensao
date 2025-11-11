<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material_pedido_de_doacao extends Model
{
    use HasFactory;

    protected $table = 'material_pedido_de_doacao';

    protected $fillable = [
        'material_id',
        'pedido_de_doacao_id',
        'quantidade',
    ];

    protected $casts = [
        'quantidade' => 'integer',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    public function pedidoDeDoacao()
    {
        return $this->belongsTo(Pedido_de_doacao::class, 'pedido_de_doacao_id');
    }

}
