<?php

namespace Tests\Unit\Rules;

use App\Http\Requests\CheckOrderRequest;
use App\Transformers\CheckOrderResponseTransformer;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;

class CheckOrderResponseTransformerTest extends TestCase
{
    /**
     * @dataProvider dataSets
     */
    public function test_transform(array $params, array $expected): void
    {
        $request = $this->createRequest($params['currency'], $params['price']);
        $transformer = new CheckOrderResponseTransformer();
        $transformed_data = $transformer->transform($request);

        $this->assertEquals($expected['currency'], $transformed_data['currency']);
        $this->assertEquals($expected['price'], $transformed_data['price']);
    }

    public static function dataSets(): array
    {
        return [
            'TWD price will not changing' => [
                ['price' => '999', 'currency' => 'TWD',],
                ['price' => '999', 'currency' => 'TWD',],
            ],
            'USD price will be exchanged to TWD' => [
                ['price' => '100', 'currency' => 'USD',],
                ['price' => '3100', 'currency' => 'TWD',],
            ],
        ];
    }

    private function createRequest($currency, $price): CheckOrderRequest
    {
        $request = new CheckOrderRequest();
        return $request->createFromBase(
            Request::create(
                uri: '/api/orders',
                method: 'POST',
                server: ['CONTENT_TYPE' => 'application/json'],
                content: '{
                    "id": "A0000001",
                    "name": "Melody Holiday Inn",
                    "address": {
                    "city": "taipei-city",
                    "district": "da-an-district",
                    "street": "fuxing-south-road"
                    },
                    "price": "' . $price . '",
                    "currency": "' . $currency . '"
                }'
            )
        );
    }
}
