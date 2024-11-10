<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckOrderRequest;
use App\Rules\AcceptCurrencies;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class CheckOrderService extends Controller
{
    private const EXCHANGE_RATE_USD_TO_TWD = 31;

    public function __invoke(CheckOrderRequest $request)
    {
        $price = (int) $request->input('price');
        $currency = $request->input('currency');
        $response = $request->all();

        try {
            if ($currency === AcceptCurrencies::CURRENCY_USD) {
                $currency = AcceptCurrencies::CURRENCY_TWD;
                $response['price'] = (string) ($price * self::EXCHANGE_RATE_USD_TO_TWD);
            }

            return response()->json($response, Response::HTTP_CREATED);

        } catch (Exception $e) {
            return response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
