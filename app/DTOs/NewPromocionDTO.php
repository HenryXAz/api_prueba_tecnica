<?php

namespace App\DTOs;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;

class NewPromocionDTO extends Data
{
    public function __construct(
        public string $titulo,
        
        public string $descripcion,

        #[MapName('codigo_descuento', 'codigoDescuento')]
        public string $codigoDescuento,

        public float $descuento,
        
        #[MapName('fecha_inicio', 'fechaInicio')]
        public Carbon $fechaInicio,

        #[MapName('fecha_fin', 'fechaFin')]
        public Carbon $fechaFin,
    ) {
    }
}
