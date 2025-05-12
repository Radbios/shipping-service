<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShippingResource extends JsonResource
{
    // Estrutura opcional para formatar a resposta do cálculo de frete (não utilizado diretamente)
    public function toArray(Request $request): array
    {
        // Retorna os dados como estão, sem modificação
        return parent::toArray($request);
    }
}

