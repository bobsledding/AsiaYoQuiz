<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckOrderRequest;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class CheckOrderService extends Controller
{
    private const PRICE_UPPER_LIMIT = 2000;
    private const CURRENCY_USD = 'USD';
    private const CURRENCY_TWD = 'TWD';
    private const ACCEPT_CURRENCIES = [self::CURRENCY_TWD, self::CURRENCY_USD];
    private const EXCHANGE_RATE_USD_TO_TWD = 31;

    public function __invoke(CheckOrderRequest $request)
    {
        $price = (int) $request->input('price');
        $currency = $request->input('currency');

        try {
            match (true) {
                ! preg_match('/^[a-zA-Z ]+$/', $request->input('name'))
                    => throw new Exception('Name contains non-English characters'),

                ! preg_match('/^[A-Z][a-z]*(\s[A-Z][a-z]*)*$/', $request->input('name'))
                    => throw new Exception('Name is not capitalized'),

                $price > self::PRICE_UPPER_LIMIT
                    => throw new Exception('Price is over ' . self::PRICE_UPPER_LIMIT),

                ! in_array($currency, self::ACCEPT_CURRENCIES)
                    => throw new Exception('Currency format is wrong'),

                default => null,
            };

            $response = $request->all();
            if ($response['currency'] === self::CURRENCY_USD) {
                $response['currency'] = self::CURRENCY_TWD;
                $response['price'] = (string) ($price * self::EXCHANGE_RATE_USD_TO_TWD);
            }

            return response()->json($response, Response::HTTP_CREATED);

        } catch (Exception $e) {
            return response($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
