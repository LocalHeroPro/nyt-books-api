<?php

declare(strict_types=1);

namespace App\Contracts;

interface DTOInterface
{
    public static function create(array $data): static;

    public function toArray(): array;
}
