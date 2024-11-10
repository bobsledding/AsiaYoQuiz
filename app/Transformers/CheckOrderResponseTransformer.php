<?php

namespace App\Transformers;

use App\Http\Requests\CheckOrderRequest;
use App\Rules\AcceptCurrencies;

class CheckOrderResponseTransformer
{
    private const EXCHANGE_RATE_USD_TO_TWD = 31;

    public function transform(CheckOrderRequest $request): array
    {
        $price = (int) $request->input('price');
        $currency = $request->input('currency');
        $response = $request->all();

        if ($currency === AcceptCurrencies::CURRENCY_USD) {
            $response['currency'] = AcceptCurrencies::CURRENCY_TWD;
            $response['price'] = (string) ($price * self::EXCHANGE_RATE_USD_TO_TWD);
        }

        return $response;
    }
}
