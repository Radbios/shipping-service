<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShippingRequest;
use App\Http\Resources\ShippingResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShippingController extends Controller
{
    // Método que calcula o valor do frete com base no CEP de destino
    public function __invoke(ShippingRequest $request)
    {
        // Dados do frete: origem fixa e pacote com dimensões e peso simulados
        $data = [
            "from" => [
                "postal_code" => "57074120" // CEP fixo de origem (ex: sede do e-commerce)
            ],
            "to" => [
                "postal_code" => $request->postal_code // CEP de destino fornecido pelo usuário
            ],
            "package" => [
                "height" => 10,
                "width" => 20,
                "length" => 15,
                "weight" => 1 // Peso em kg (simulação padrão)
            ]
        ];

        // Envia requisição POST para a API do Melhor Envio para calcular o valor do frete
        return Http::withHeaders([
                "Content-Type" => "application/json",
                "User-Agent" => env("EMAIL"), // Identificação do usuário configurada no .env
                "Authorization" => "Bearer " . env("SHIPPING_TOKEN"), // Token de acesso à API
                "Accept" => "application/json"
            ])->post("https://www.melhorenvio.com.br/api/v2/me/shipment/calculate", $data);
    }
}
