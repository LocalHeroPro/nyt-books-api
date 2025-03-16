<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\NYT\Books;

use App\DTOs\Api\V1\NYT\Books\BestSellerDTO;
use App\Factories\DTOFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\NYT\Books\BestSellerListingRequest;
use App\Services\NYT\Books\BestSellerService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class BestSellerController extends Controller
{
    /**
     * @throws ConnectionException
     */
    #[Route('/api/v1/nyt/books/best-sellers', name: 'api.v1.nyt.books.best_sellers', methods: ['GET'])]
    public function __invoke(BestSellerListingRequest $request, BestSellerService $bestSellerService): JsonResponse
    {
        $bestSellerDTO = DTOFactory::createObject(BestSellerDTO::class, $request->validated());

        return $bestSellerService->index($bestSellerDTO);
    }
}
