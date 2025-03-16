<?php

declare(strict_types=1);

namespace Tests\DataProviders\Helpers;

class ArrayHelperDataProvider
{
    public static function getArrayValue(): \Generator
    {
        yield 'empty string' => ['array' => ['name' => 'John Doe', 'email' => '', 'age' => 14]];
        yield 'null' => ['array' => ['name' => 'John Doe', 'email' => null, 'age' => 21]];
        yield 'empty string and null' => ['array' => ['name' => '', 'email' => null, 'age' => 65]];
        yield 'empty string, null and zero' => ['array' => ['name' => '', 'email' => null, 'age' => 0]];
    }
}
