<?php

use App\Http\Controllers\CheckOrderService;
use App\Http\Middleware\OnlyAcceptJsonMiddleware;
use Illuminate\Support\Facades\Route;

Route::post('/orders', CheckOrderService::class)
    ->middleware(OnlyAcceptJsonMiddleware::class);
