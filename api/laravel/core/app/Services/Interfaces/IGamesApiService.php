<?php

namespace App\Services\Interfaces;

use App\Http\Requests\GamePaginationRequest;
use Illuminate\Http\JsonResponse;

interface IGamesApiService
{
    public function index(GamePaginationRequest $request):JsonResponse;
    public function show(string $id):JsonResponse;

}
