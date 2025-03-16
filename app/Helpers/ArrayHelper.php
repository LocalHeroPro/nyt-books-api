<?php

declare(strict_types=1);

namespace App\Helpers;

class ArrayHelper
{
    public static function clean(array $array): array
    {
        return array_filter($array, fn($value) => ! \is_null($value) && $value !== '');
    }
}
