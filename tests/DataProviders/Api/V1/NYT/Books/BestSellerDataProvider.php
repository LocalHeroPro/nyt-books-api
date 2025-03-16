<?php

declare(strict_types=1);

namespace Tests\DataProviders\Api\V1\NYT\Books;

use Faker\Factory;
use Faker\Generator;

class BestSellerDataProvider
{
    private static ?Generator $faker = null;

    private static function getFaker(): Generator
    {
        if (self::$faker === null) {
            self::$faker = Factory::create();
        }

        return self::$faker;
    }

    public static function getValidParameters(): \Generator
    {
        $baseDir = __DIR__ . \sprintf(
            '%1$s..%1$s..%1$s..%1$s..%1$s..%1$sStubs/Api/V1/NYT/Books/BestSellerService%1$s',
            DIRECTORY_SEPARATOR,
        );

        yield 'empty' => ['parameters' => [], 'mock' => file_get_contents($baseDir . 'empty_parameters.json')];
        yield 'search by author' => [
            'parameters' => ['author' => 'Stephen King'],
            'mock' => file_get_contents($baseDir . 'autor_parameters.json'),
        ];
        yield 'search by title' => [
            'parameters' => ['title' => 'The Institute'],
            'mock' => file_get_contents($baseDir . 'title_parameters.json'),
        ];
        yield 'offset' => [
            'parameters' => ['offset' => 20],
            'mock' => file_get_contents($baseDir . 'offset_parameters.json'),
        ];
        yield 'one isbn' => [
            'parameters' => ['isbn' => ['9781982110567']],
            'mock' => file_get_contents($baseDir . 'isbn_parameters.json'),
        ];
        yield 'multiple isbn' => [
            'parameters' => ['isbn' => ['9780446579933', '0061374229']],
            'mock' => file_get_contents($baseDir . 'isbn_multiple_parameters.json'),
        ];
    }

    public static function getInvalidParameters(): \Generator
    {
        $faker = self::getFaker();

        yield 'invalid author' => ['parameters' => ['author' => $faker->text(500)], 'invalidKeys' => ['author']];
        yield 'invalid isbn type' => ['parameters' => ['isbn' => $faker->word], 'invalidKeys' => ['isbn']];
        yield 'invalid isbn' => ['parameters' => ['isbn' => [$faker->word]], 'invalidKeys' => ['isbn.0']];
        yield 'invalid title' => ['parameters' => ['title' => $faker->text(500)], 'invalidKeys' => ['title']];
        yield 'invalid offset' => ['parameters' => ['offset' => $faker->word], 'invalidKeys' => ['offset']];
    }

    public static function getUnauthorizedResponse(): \Generator
    {
        $baseDir = __DIR__ . \sprintf(
            '%1$s..%1$s..%1$s..%1$s..%1$s..%1$sStubs/Api/V1/NYT/Books/BestSellerService/%1$s',
            DIRECTORY_SEPARATOR,
        );

        yield 'unauthorized' => ['mock' => file_get_contents($baseDir . 'unauthorized.json')];
    }
}
