<?php

namespace App\Http\Controllers;

use App\DTOs\UpdatePromocionDTO;
use App\Http\Requests\NewPromocionRequest;
use App\Http\Requests\UpdatePromocionRequest;
use App\Services\IPromocionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PromocionesController extends Controller
{
    public function __construct(
        private readonly IPromocionService $promocionService
    )
    {}

    public function  index() : JsonResponse 
    {
        try {
            return new JsonResponse([
                "message" => "success",
                "data" => $this->promocionService->getAll(),
            ],
            Response::HTTP_OK,
            );
        } catch (\Throwable $th) {
            return new JsonResponse([
                "message" => "internal server error",
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR,
            );
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            return new JsonResponse([
                "data" => $this->promocionService->findById($id),
            ],
            Response::HTTP_OK,
            );
        } catch (\Throwable $th) {
            if($th  instanceof NotFoundHttpException) {
                return new JsonResponse([
                    "message" => $th->getMessage(),
                ],
                $th->getCode(),
                );
            }

            return new JsonResponse([
                "message" => "internal server error",
                // "message" => $th->getMessage(),
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR,
            );
        }
    }

    public function store(NewPromocionRequest $request): JsonResponse
    {
        try {
            $promocion = $request->data();

            return new JsonResponse([
                "message" => "success",
                "data" => $this->promocionService->create($promocion),
            ],
            Response::HTTP_CREATED,
            );
        } catch (\Throwable $th) {
            return new JsonResponse([
                "message" => "internal server error",
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR,
            );
        }
    }

    public function update(int $id, UpdatePromocionRequest $request): JsonResponse
    {
        try {
            $promocion = $request->data();

            return new JsonResponse([
                "message" => "success",
                "data" => $this->promocionService->update($promocion, $id),
            ],
            Response::HTTP_OK,
            );
        } catch (\Throwable $th) {
            if($th  instanceof NotFoundHttpException) {
                return new JsonResponse([
                    "message" => $th->getMessage(),
                ],
                $th->getCode(),
                );
            }

            return new JsonResponse([
                // "message" => "internal server error",
                "message" => $th->getMessage(),
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR,
            );
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $action = $this->promocionService->delete($id);
            return new JsonResponse([
                "message" => "success",
                "status" => $action,
            ],
                Response::HTTP_OK,
            );
        } catch (\Throwable $th) {
            if($th  instanceof NotFoundHttpException) {
                return new JsonResponse([
                    "message" => $th->getMessage(),
                ],
                $th->getCode(),
                );
            }

            return new JsonResponse([
                "message" => "internal server error",
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR,
            );
        }
    }
}
