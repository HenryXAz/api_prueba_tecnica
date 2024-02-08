<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
    ];

    protected $fillable = [
        'descripcion',
        'titulo',
        'codigo_descuento',
        'descuento',
        'fecha_inicio',
        'fecha_fin'
    ];

    protected $table = 'promociones';
}
