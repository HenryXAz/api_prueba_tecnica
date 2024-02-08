<?php
namespace App\DTOs;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class PromocionDTO extends Data
{
    public function __construct(
        public int $id,
        public string $titulo,
        public string $descripcion,

        #[MapName('codigo_descuento', 'codigoDescuento')]
        public string $codigoDescuento,
        
        public float $descuento,

        #[WithCast(DateTimeInterfaceCast::class, timeZone: 'America/Guatemala')]
        #[MapName('fecha_inicio', 'fechaInicio')]
        public Carbon $fechaInicio,

        #[WithCast(DateTimeInterfaceCast::class, timeZone: 'America/Guatemala')]
        #[MapName('fecha_fin', 'fechaFin')]
        public Carbon $fechaFin,
    )
    {}
}