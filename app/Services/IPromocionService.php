<?php
namespace App\Services;

use App\DTOs\NewPromocionDTO;
use App\DTOs\PromocionDTO;
use App\DTOs\UpdatePromocionDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Spatie\LaravelData\DataCollection;

interface IPromocionService
{
    public function getAll(): DataCollection;
    public function findById(int $id):PromocionDTO ;
    public function create(NewPromocionDTO $newPromocion): PromocionDTO;
    public function update(UpdatePromocionDTO $promocionUpdated, int $id): PromocionDTO;
    public function delete(int $id): bool;
}