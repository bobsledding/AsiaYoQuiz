<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckOrderRequest;
use App\Rules\AcceptCurrencies;
use App\Transformers\CheckOrderResponseTransformer;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class CheckOrderService extends Controller
{
    public function __invoke(CheckOrderRequest $request, CheckOrderResponseTransformer $transformer)
    {
        try {
            return response()->json($transformer->transform($request), Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
