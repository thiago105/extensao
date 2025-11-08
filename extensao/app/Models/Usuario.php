<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public function materiais_coletados()
    {
        return $this->hasMany(Materiais_coletado::class);
    }

    protected $fillable = [
        'nome', 'email', 'genero', 'cpf', 'data_de_nascimento',
        'telefone', 'endereco', 'senha'
    ];
    protected $hidden = ['senha'];
    
}
