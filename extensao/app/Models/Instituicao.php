<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function estoque()
    {
        return $this->hasMany(Estoque::class);
    }

    public function ponto_de_coleta()
    {
        return $this->hasMany(Ponto_de_coleta::class);
    }

    protected $fillable = [
        'nome', 'cnpj', 'endereco', 'email', 'senha'
    ];
    protected $hidden = ['senha'];
    
}
