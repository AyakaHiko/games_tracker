<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GamePaginationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'page' => 'integer|min:1',
            'page_size' => 'integer|min:1',
            'search' => 'nullable|string',
            ];
    }
    public function messages(): array
    {
        return [
            'page.integer' => 'The page must be an integer.',
            'page.min' => 'The page must be at least 1.',
            'page_size.integer' => 'The page size must be an integer.',
            'page_size.min' => 'The page size must be at least 1.',
            'search.string' => 'The search parameter must be a string.',
        ];
    }
}
