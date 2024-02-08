<?php
namespace App\Services;

use App\DTOs\NewPromocionDTO;
use App\DTOs\PromocionDTO;
use App\DTOs\UpdatePromocionDTO;
use App\Models\Promocion;
use DateTime;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Spatie\LaravelData\DataCollection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PromocionService implements IPromocionService
{
    public function getAll(): DataCollection
    {
        return PromocionDTO::collection(Promocion::all());
    }

    public function findById(int $id): PromocionDTO
    {
        $promocion = Promocion::find($id);
        

        if($promocion == null) {
            throw new NotFoundHttpException('promocion not found', null, Response::HTTP_NOT_FOUND);
        }
        $promocion->descuento = ($promocion->descuento != null) ? round($promocion->descuento, 2) : 0;
        return PromocionDTO::from($promocion);
    }

    public function create(NewPromocionDTO $newPromocion): PromocionDTO
    {
        $promocion = new Promocion();
        $promocion->titulo = $newPromocion->titulo;
        $promocion->descripcion = $newPromocion->descripcion;
        $promocion->codigo_descuento = $newPromocion->codigoDescuento;
        $promocion->descuento = round($newPromocion->descuento, 2);
        $promocion->fecha_inicio = $newPromocion->fechaInicio;
        $promocion->fecha_fin = $newPromocion->fechaFin;
        $promocion->save();

        if($promocion == false) {
            throw new Exception('internal server error');
        }

        return PromocionDTO::from($promocion);
    }

    public function update(UpdatePromocionDTO $promocionUpdated, int $id): PromocionDTO
    {
        $promocionFound = Promocion::find($id);

        if($promocionFound == null) {
            throw new NotFoundHttpException('promocion not found', null, Response::HTTP_NOT_FOUND);
        }

        $promocion = new Promocion();
        $promocion->titulo = $promocionUpdated->titulo;
        $promocion->descripcion = $promocionUpdated->descripcion;
        $promocion->codigo_descuento = $promocionUpdated->codigoDescuento;
        $promocion->descuento = ($promocion->descuento != null) ? round($promocion->descuento, 2) : 0;
        $promocion->fecha_inicio = $promocionUpdated->fechaInicio;
        $promocion->fecha_fin = $promocionUpdated->fechaFin;

        $data = $promocion->toArray();
        $data = array_filter($data, fn($attribute) => $attribute != null);
        $promocionFound->update($data);

        return PromocionDTO::from($promocionFound);
    }

    public function delete(int $id): bool
    {
        $promocionFound = Promocion::find($id);

        if($promocionFound == null) {
            throw new NotFoundHttpException('promocion not found', null, Response::HTTP_NOT_FOUND);
        }

        $promocionFound->delete();
        return true;
    }
}