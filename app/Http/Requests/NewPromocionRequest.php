<?php

namespace App\Http\Requests;

use App\DTOs\NewPromocionDTO;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class NewPromocionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'descripcion' => 'required',
            'titulo' => 'required',
            'codigo_descuento' => 'required',
            'descuento' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
        ];
    }

    function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(new JsonResponse([
            'message' => 'bad request',
            'errors' => $validator->errors(),
        ],
        Response::HTTP_BAD_REQUEST,
        ));
    }

    public function data(): NewPromocionDTO
    {
        return NewPromocionDTO::from([
            'descripcion' => $this->input('descripcion'),
            'titulo' => $this->input('titulo'),
            'codigo_descuento' => $this->input('codigo_descuento'),
            'descuento' => $this->input('descuento'),
            'fecha_inicio' => $this->input('fecha_inicio'),
            'fecha_fin' => $this->input('fecha_fin')
        ]);
    }
}
