<?php

declare(strict_types=1);

namespace Tests\DataProviders\DTOs;

class BestSellerDTODataProvider
{
    public static function getData(): \Generator
    {
        yield 'empty set' => [
            'data' => [
                'author' => null,
                'title' => null,
                'isbn' => null,
                'offset' => null,
            ],
        ];

        yield 'author' => [
            'data' => [
                'author' => 'author',
                'title' => null,
                'isbn' => null,
                'offset' => null,
            ],
        ];

        yield 'title' => [
            'data' => [
                'author' => null,
                'title' => 'title',
                'isbn' => null,
                'offset' => null,
            ],
        ];

        yield 'isbn' => [
            'data' => [
                'author' => null,
                'title' => null,
                'isbn' => ['isbn'],
                'offset' => null,
            ],
        ];

        yield 'offset' => [
            'data' => [
                'author' => null,
                'title' => null,
                'isbn' => null,
                'offset' => 20,
            ],
        ];
    }
}
