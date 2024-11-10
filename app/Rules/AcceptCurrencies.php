<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AcceptCurrencies implements ValidationRule
{
    public const CURRENCY_USD = 'USD';
    public const CURRENCY_TWD = 'TWD';
    private const ACCEPT_CURRENCIES = [self::CURRENCY_TWD, self::CURRENCY_USD];
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! in_array($value, self::ACCEPT_CURRENCIES)) {
            $fail('Currency format is wrong');
        }
    }
}
