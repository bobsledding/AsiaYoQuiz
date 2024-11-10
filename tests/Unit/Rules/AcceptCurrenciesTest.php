<?php

namespace Tests\Unit\Rules;

use App\Rules\AcceptCurrencies;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class AcceptCurrenciesTest extends TestCase
{
    public function test_valid_currencies(): void
    {
        $validator = Validator::make(['currency' => 'TWD'], ['currency' => new AcceptCurrencies()]);
        $this->assertTrue($validator->passes());

        $validator = Validator::make(['currency' => 'USD'], ['currency' => new AcceptCurrencies()]);
        $this->assertTrue($validator->passes());
    }

    public function test_invalid_currencies(): void
    {
        $validator = Validator::make(['currency' => 'JPY'], ['currency' => new AcceptCurrencies()]);
        $this->assertFalse($validator->passes());

        $validator = Validator::make(['currency' => 'EUR'], ['currency' => new AcceptCurrencies()]);
        $this->assertFalse($validator->passes());
    }
}
