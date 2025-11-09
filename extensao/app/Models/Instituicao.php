<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
    use HasFactory;

    protected $table = 'instituicaos';

    protected $fillable = [
        'name',
        'email',
        'password',
        'cnpj',
        'endereco',
    ];

    protected $hidden = ['password'];

    public function estoque()
    {
        return $this->hasMany(Estoque::class);
    }

    public function mateirais_coletado()
    {
        return $this->hasMany(Mateirais_coletado::class);
    }

    public function ponto_de_coleta()
    {
        return $this->hasMany(Ponto_de_coleta::class);
    }
}
