<?php
namespace App\DTOs;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;

class UpdatePromocionDTO extends Data
{
    public function __construct(
        public ?string $titulo,
        public ?string $descripcion,
        #[MapName('codigo_descuento', 'codigoDescuento')]
        public ?string $codigoDescuento,
        public ?float $descuento,
        #[MapName('fecha_inicio', 'fechaInicio')]
        public ?\Carbon\Carbon $fechaInicio,
        #[MapName('fechaInicio', 'fechaFin')]
        public ?\Carbon\Carbon $fechaFin,
    )
    {}
}