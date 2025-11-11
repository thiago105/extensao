<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    use  HasFactory;

    protected $table = "entrega";

    protected $fillable = [
        'instituicaos_id',
        'pedido_de_doacao_id',
    ];

    public function pedidoDeDoacao()
    {
        return $this->belongsTo(Pedido_de_doacao::class, 'pedido_de_doacao_id');
    }

     public function instituicao()
    {
        return $this->belongsTo(Instituicao::class, 'instituicaos_id');
    }

}
