<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PriceUpperLimit implements ValidationRule
{
    private const PRICE_UPPER_LIMIT = 2000;

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value > self::PRICE_UPPER_LIMIT) {
            $fail('Price is over ' . self::PRICE_UPPER_LIMIT);
        }
    }
}
