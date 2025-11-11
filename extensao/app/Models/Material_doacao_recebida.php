<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material_doacao_recebida extends Model
{
    use HasFactory;

    protected $table = 'material_doacao_recebida';

    protected $fillable = [
        'material_id',
        'doacao_recebida_id',
        'estado',
        'quantidade',
    ];

    protected $casts = [
        'quantidade' => 'integer',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    public function doacaoRecebida()
    {
        return $this->belongsTo(Doacao_recebida::class, 'doacao_recebida_id');
    }
}
