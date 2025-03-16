<?php

declare(strict_types=1);

namespace App\DTOs\Api\V1\NYT\Books;

use App\Contracts\DTOInterface;
use App\DTOs\Traits\StaticCreateSelf;
use App\DTOs\Traits\ToArray;
use App\Helpers\NumberHelper;

class BestSellerDTO implements DTOInterface
{
    use StaticCreateSelf;
    use ToArray;

    private ?string $author;
    private ?string $title;
    /** @var null|string[] */
    private ?array $isbn;
    private ?int $offset
    {
        set(int|string|null $offset) {
            $offset = NumberHelper::castToIntOrReturnValue($offset);
            if ($offset % 20 !== 0) {
                throw new \InvalidArgumentException('Offset must be a multiple of 20');
            }

            $this->offset = $offset;
        }
    }
}
