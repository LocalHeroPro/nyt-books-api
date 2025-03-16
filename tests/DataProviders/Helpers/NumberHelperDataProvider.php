<?php

declare(strict_types=1);

namespace Tests\DataProviders\Helpers;

class NumberHelperDataProvider
{
    public static function getProperIntValues(): \Generator
    {
        yield 'int' => ['value' => 184, 'expected' => 184];
        yield 'unsigned int' => ['value' => -184, 'expected' => -184];
        yield 'string' => ['value' => '14', 'expected' => 14];
        yield 'unsigned string' => ['value' => '-15', 'expected' => -15];
    }

    public static function getValuesWeCantCast(): \Generator
    {
        yield 'string' => ['value' => 'das'];
        yield 'array' => ['value' => ['das2']];
    }
}
