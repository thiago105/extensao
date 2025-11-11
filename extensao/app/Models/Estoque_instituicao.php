<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque_instituicao extends Model
{
    use HasFactory;

    protected $table = 'estoque_instituicaos';

    protected $fillable = [
        'instituicaos_id',
        'material_id',
        'quantidade',
    ];

    protected $casts = [
        'quantidade' => 'integer',
    ];
    public function instituicao()
    {
        return $this->belongsTo(Instituicao::class, 'instituicaos_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
}
