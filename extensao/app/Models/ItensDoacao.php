<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItensDoacao extends Model
{
    use HasFactory;

    protected $table = 'itens_doacao';

    protected $fillable = ['id_doacao', 'id_mateirais_coletados', 'quantidade'];

    public function doacao()
    {
        return $this->belongsTo(Doacao::class, 'id_doacao');
    }

    public function mateirais_coletado()
    {
        return $this->belongsTo(Mateirais_coletado::class, 'id_mateirais_coletados');
    }
}
