<?php

declare(strict_types=1);

namespace App\Services\NYT\Books;

use App\DTOs\Api\V1\NYT\Books\BestSellerDTO;
use App\Helpers\ArrayHelper;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class BestSellerService
{
    /**
     * @throws ConnectionException
     */
    public function index(BestSellerDTO $bestSellerDTO): JsonResponse
    {
        $parametersArray = $bestSellerDTO->toArray();
        $parameters = ArrayHelper::clean($parametersArray);
        $parameters['api-key'] = config('services.nyt.books.api_key');

        $isbnArray = Arr::get($parameters, 'isbn');
        if (! \is_null($isbnArray)) {
            $parameters['isbn'] = implode(';', $isbnArray);
        }

        $response = Http::acceptJson()
            ->withQueryParameters($parameters)
            ->get(config('services.nyt.books.url'));

        return response()->json($response->json(), $response->status());
    }
}
