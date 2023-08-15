<?php

namespace App\Http\Requests\GameListApi;

use Illuminate\Foundation\Http\FormRequest;

class GameListRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'game_id' => 'required|numeric',
            'list_id' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'game_id.required' => 'The Game ID field is required.',
            'game_id.numeric' => 'The Game ID must be a numeric value.',
            'list_id.required' => 'The List ID field is required.',
            'list_id.numeric' => 'The List ID must be a numeric value.',
        ];
    }
}
