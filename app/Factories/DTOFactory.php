<?php

declare(strict_types=1);

namespace App\Factories;

use App\Contracts\DTOInterface;

class DTOFactory
{
    public static function createObject(string $classType, array $data): DTOInterface
    {
        if (class_exists($classType) && \in_array(DTOInterface::class, class_implements($classType))) {
            return $classType::create($data);
        }

        throw new \UnexpectedValueException("Class {$classType} does not exist or does not implement DTOInterface.");
    }
}
