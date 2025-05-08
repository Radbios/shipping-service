<?php

use App\Auth;
use App\Http\Controllers\ShippingController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use laravel\correios\Calculo\Calculo;


Route::middleware("api_auth")->group(function() {
    Route::get("/shipping", ShippingController::class);
});
