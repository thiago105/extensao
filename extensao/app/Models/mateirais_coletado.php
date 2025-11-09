<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mateirais_coletado extends Model
{
    use HasFactory;

    protected $table = 'mateirais_coletados'; // nome da tabela
    protected $fillable = ['id_instituicao', 'material', 'condicao', 'quantidade'];

    public function instituicao()
    {
        return $this->belongsTo(Instituicao::class, 'id_instituicao');
    }
}
