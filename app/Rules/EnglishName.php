<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EnglishName implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! preg_match('/^[a-zA-Z ]+$/', $value)) {
            $fail('Name contains non-English characters');
        }
    }
}
