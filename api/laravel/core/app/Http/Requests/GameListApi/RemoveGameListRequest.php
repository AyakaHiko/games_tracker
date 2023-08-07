<?php

namespace App\Http\Requests\GameListApi;

use Illuminate\Foundation\Http\FormRequest;

class RemoveGameListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'list_id' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'list_id.required' => 'The List ID field is required.',
            'list_id.numeric' => 'The List ID must be a numeric value.',
        ];
    }
}

