<?php
namespace App\Http\Requests\GameListApi;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateGameListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'list_name' => 'required|string|max:255',
            'list_type_id' => 'required|integer|min:1',
        ];
    }
}
