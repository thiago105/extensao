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


    public function estoque_instituicao()
    {
        return $this->hasMany(Estoque_instituicao::class);
    }

    public function entrega()
    {
        return $this->hasMany(Entrega::class);
    }

    public function ponto_de_coleta()
    {
        return $this->hasMany(Ponto_de_coleta::class);
    }
}