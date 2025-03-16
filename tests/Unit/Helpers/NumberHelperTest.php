<?php

declare(strict_types=1);

namespace Tests\Unit\Helpers;

use App\Helpers\NumberHelper;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Tests\DataProviders\Helpers\NumberHelperDataProvider;

class NumberHelperTest extends TestCase
{
    /**
     * @see NumberHelper::castToIntOrReturnValue
     */
    #[DataProviderExternal(NumberHelperDataProvider::class, 'getProperIntValues')]
    public function test_check_casting_to_int(mixed $value, int $expected): void
    {
        // arrange

        // act
        $result = NumberHelper::castToIntOrReturnValue($value);

        // assert
        self::assertSame($expected, $result);
    }

    /**
     * @see NumberHelper::castToIntOrReturnValue
     */
    #[DataProviderExternal(NumberHelperDataProvider::class, 'getValuesWeCantCast')]
    public function test_check_not_cast(mixed $value): void
    {
        // arrange

        // act
        $result = NumberHelper::castToIntOrReturnValue($value);

        // assert
        self::assertSame($value, $result);
    }
}
