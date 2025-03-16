<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IsbnRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        preg_match('/^(97(8|9))?\d{9}(\d|X)$/', $value) === 1 ?: $fail("The {$attribute} is not a valid ISBN.")->translate();
    }
}
