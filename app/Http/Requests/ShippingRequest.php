<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingRequest extends FormRequest
{
    // Autoriza a requisição independentemente do usuário (sem restrição)
    public function authorize(): bool
    {
        return true;
    }

    // Regras de validação: exige que o campo 'postal_code' esteja presente
    public function rules(): array
    {
        return [
            "postal_code" => ["required"] // O CEP de destino é obrigatório
        ];
    }
}
