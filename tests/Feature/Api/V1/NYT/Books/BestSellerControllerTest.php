<?php

declare(strict_types=1);

namespace Feature\Api\V1\NYT\Books;

use App\Http\Controllers\Api\V1\NYT\Books\BestSellerController;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Passport;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use Symfony\Component\HttpFoundation\Response;
use Tests\DataProviders\Api\V1\NYT\Books\BestSellerDataProvider;
use Tests\TestCase;

class BestSellerControllerTest extends TestCase
{
    /**
     * Expected response status code: 200
     *
     * @see BestSellerController::__invoke
     */
    #[DataProviderExternal(BestSellerDataProvider::class, 'getValidParameters')]
    public function test_index_no_auth(array $parameters, string $mock): void
    {
        // arrange
        Http::fake(['*' => Http::response($mock, Response::HTTP_OK)]);
        $parameters = http_build_query($parameters);

        // act
        $response = $this->getJson("/api/v1/nyt/books/best-sellers?{$parameters}");

        // assert
        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'copyright',
            'num_results',
            'results' => [
                '*' => [
                    'title',
                    'description',
                    'contributor',
                    'author',
                    'contributor_note',
                    'price',
                    'age_group',
                    'publisher',
                    'isbns' => [
                        '*' => [
                            'isbn10',
                            'isbn13',
                        ],
                    ],
                    'ranks_history' => [
                        '*' => [
                            'primary_isbn10',
                            'primary_isbn13',
                            'rank',
                            'list_name',
                            'display_name',
                            'published_date',
                            'bestsellers_date',
                            'weeks_on_list',
                            'rank_last_week',
                            'asterisk',
                            'dagger',
                        ],
                    ],
                    'reviews' => [
                        '*' => [
                            'book_review_link',
                            'first_chapter_link',
                            'sunday_review_link',
                            'article_chapter_link',
                        ],
                    ],
                ],
            ],
        ]);
    }

    /**
     * Expected response status code: 200
     *
     * @see BestSellerController::__invoke
     */
    #[DataProviderExternal(BestSellerDataProvider::class, 'getValidParameters')]
    public function test_index_with_auth(array $parameters, string $mock): void
    {
        // arrange
        Http::fake(['*' => Http::response($mock, Response::HTTP_OK)]);
        $parameters = http_build_query($parameters);

        // act
        Passport::actingAs(User::factory()->create());
        $response = $this->getJson("/api/v1/nyt/books/best-sellers?{$parameters}");

        // assert
        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'copyright',
            'num_results',
            'results' => [
                '*' => [
                    'title',
                    'description',
                    'contributor',
                    'author',
                    'contributor_note',
                    'price',
                    'age_group',
                    'publisher',
                    'isbns' => [
                        '*' => [
                            'isbn10',
                            'isbn13',
                        ],
                    ],
                    'ranks_history' => [
                        '*' => [
                            'primary_isbn10',
                            'primary_isbn13',
                            'rank',
                            'list_name',
                            'display_name',
                            'published_date',
                            'bestsellers_date',
                            'weeks_on_list',
                            'rank_last_week',
                            'asterisk',
                            'dagger',
                        ],
                    ],
                    'reviews' => [
                        '*' => [
                            'book_review_link',
                            'first_chapter_link',
                            'sunday_review_link',
                            'article_chapter_link',
                        ],
                    ],
                ],
            ],
        ]);
    }

    /**
     * Expected response status code: 422
     *
     * @see BestSellerController::__invoke
     */
    #[DataProviderExternal(BestSellerDataProvider::class, 'getInvalidParameters')]
    public function test_index_with_invalid_parameters_no_auth(array $parameters, array $invalidKeys): void
    {
        // arrange
        $parameters = http_build_query($parameters);

        // act
        $response = $this->getJson("/api/v1/nyt/books/best-sellers?{$parameters}");

        // assert
        $response->assertUnprocessable();
        $response->assertJsonStructure(['message', 'errors']);
        $response->assertJsonValidationErrors($invalidKeys);
    }

    /**
     * Expected response status code: 422
     *
     * @see BestSellerController::__invoke
     */
    #[DataProviderExternal(BestSellerDataProvider::class, 'getInvalidParameters')]
    public function test_index_with_invalid_parameters_with_auth(array $parameters, array $invalidKeys): void
    {
        // arrange
        $parameters = http_build_query($parameters);

        // act
        Passport::actingAs(User::factory()->create());
        $response = $this->getJson("/api/v1/nyt/books/best-sellers?{$parameters}");

        // assert
        $response->assertUnprocessable();
        $response->assertJsonStructure(['message', 'errors']);
        $response->assertJsonValidationErrors($invalidKeys);
    }

    /**
     * Expected response status code: 401
     *
     * @see BestSellerController::__invoke
     */
    #[DataProviderExternal(BestSellerDataProvider::class, 'getUnauthorizedResponse')]
    public function test_unauthorized_response(string $mock): void
    {
        // arrange
        Http::fake(['*' => Http::response($mock, Response::HTTP_UNAUTHORIZED)]);

        // act
        $response = $this->getJson('/api/v1/nyt/books/best-sellers');

        // assert
        $response->assertUnauthorized();
        $response->assertJsonStructure(['fault' => ['faultstring', 'detail' => ['errorcode']]]);
    }
}
