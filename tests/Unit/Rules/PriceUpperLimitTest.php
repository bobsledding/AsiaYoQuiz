<?php

namespace Tests\Unit\Rules;

use App\Rules\PriceUpperLimit;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class PriceUpperLimitTest extends TestCase
{
    public function test_under_upper_limit(): void
    {
        $validator = Validator::make(['price' => '1900'], ['price' => new PriceUpperLimit()]);

        $this->assertTrue($validator->passes());
    }

    public function test_over_upper_limit(): void
    {
        $validator = Validator::make(['price' => '2100'], ['price' => new PriceUpperLimit()]);

        $this->assertFalse($validator->passes());
    }

    public function test_equals_upper_limit(): void
    {
        $validator = Validator::make(['price' => '2000'], ['price' => new PriceUpperLimit()]);

        $this->assertTrue($validator->passes());
    }
}
