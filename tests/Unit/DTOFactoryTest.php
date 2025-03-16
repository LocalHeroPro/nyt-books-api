<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\DTOs\Api\V1\NYT\Books\BestSellerDTO;
use App\Factories\DTOFactory;
use App\Models\User;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Tests\DataProviders\DTOs\BestSellerDTODataProvider;

class DTOFactoryTest extends TestCase
{
    /**
     * @see DTOFactory::createObject
     */
    #[DataProviderExternal(BestSellerDTODataProvider::class, 'getData')]
    public function test_create_DTO(array $data): void
    {
        // arrange

        // act
        $bestSellerDTO = DTOFactory::createObject(BestSellerDTO::class, $data);

        // assert
        $this->assertInstanceOf(BestSellerDTO::class, $bestSellerDTO);
    }

    /**
     * @see DTOFactory::createObject
     */
    public function test_create_wrong_DTO(): void
    {
        // arrange
        $classType = User::class;

        // act
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage("Class {$classType} does not exist or does not implement DTOInterface.");
        DTOFactory::createObject($classType, []);
    }
}
