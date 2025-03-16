<?php

declare(strict_types=1);

namespace App\DTOs\Traits;

trait StaticCreateSelf
{
    /**
     * @throws \ReflectionException
     */
    public static function create(array $values): static
    {
        $dto = new static();
        $reflection = new \ReflectionClass($dto);

        foreach ($values as $key => $value) {
            if (property_exists($dto, $key)) {
                $property = $reflection->getProperty($key);
                $type = $property->getType();

                $dto->{$key} = $type && enum_exists($type->getName())
                    ? $type->getName()::from($value)
                    : $value;
            }
        }

        return $dto;
    }
}
