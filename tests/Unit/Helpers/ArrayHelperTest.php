<?php

declare(strict_types=1);

namespace Tests\Unit\Helpers;

use App\Helpers\ArrayHelper;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Tests\DataProviders\Helpers\ArrayHelperDataProvider;

class ArrayHelperTest extends TestCase
{
    /**
     * @see ArrayHelper::clean
     */
    #[DataProviderExternal(ArrayHelperDataProvider::class, 'getArrayValue')]
    public function test_check_removed_values(array $array): void
    {
        // arrange

        // act
        $result = ArrayHelper::clean($array);

        // assert
        foreach ($result as $value) {
            self::assertNotSame(null, $value);
            self::assertNotSame('', $value);
        }
    }
}
