<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Instituicao extends Authenticatable
{
    use Notifiable;

    protected $table = 'instituicaos';

    protected $fillable = [
        'name',
        'email',
        'password',
        'cnpj',
        'endereco',
    ];

    protected $hidden = ['password', 'remember_token'];


    public function estoque()
    {
        return $this->hasMany(Estoque::class);
    }

    public function ponto_de_coleta()
    {
        return $this->hasMany(Ponto_de_coleta::class);
    }
}