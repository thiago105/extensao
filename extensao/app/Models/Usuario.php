<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nome',
        'email',
        'genero',
        'cpf',
        'data_de_nascimento',
        'telefone',
        'endereco',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function instituicoes()
    {
        return $this->hasMany(Instituicao::class);
    }

    
}