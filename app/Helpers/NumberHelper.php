<?php

declare(strict_types=1);

namespace App\Helpers;

class NumberHelper
{
    public static function castToIntOrReturnValue(mixed $value): mixed
    {
        return is_numeric($value) && (int) $value == $value
            ? (int) $value
            : $value;
    }
}
