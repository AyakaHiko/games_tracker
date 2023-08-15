<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetGameListsRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id', // user_id обязателен и должен существовать в таблице users
            'list_type' => 'nullable|in:Custom,Wishlist,Completed,Uncompleted', // list_type (тип списка) не обязателен, но может быть только одним из указанных значений
            'list_name' => 'nullable|string', // list_name (название списка) не обязателен, но должен быть строкой
        ];
    }
}
