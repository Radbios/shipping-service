<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShippingRequest;
use App\Http\Resources\ShippingResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShippingController extends Controller
{
    public function __invoke(ShippingRequest $request)
    {
        $data = [
            "from" => [
                "postal_code" => "57074120"
            ],
            "to" => [
                "postal_code" => $request->postal_code
            ],
            "package" => [
                "height" => 10,
                "width" => 20,
                "length" => 15,
                "weight" => 1
            ]
        ];
        return Http::withHeaders([
                "Content-Type" => "application/json",
                "User-Agent" => env("EMAIL"),
                "Authorization" => "Bearer " . env("SHIPPING_TOKEN"),
                "Accept" => "application/json"
            ])->post("https://www.melhorenvio.com.br/api/v2/me/shipment/calculate", $data);
    }
}
