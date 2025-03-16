<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\NYT\Books;

use App\Rules\IsbnRule;
use Illuminate\Foundation\Http\FormRequest;

class BestSellerListingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'author' => 'sometimes|nullable|string|max:255',
            'isbn' => 'sometimes|array|nullable',
            'isbn.*' => ['sometimes', 'string', 'min:10', 'max:13', new IsbnRule()],
            'title' => 'sometimes|nullable|string|max:255',
            'offset' => 'sometimes|nullable|int|min:0|multiple_of:20|max:1000',
        ];
    }
}
