<?php

namespace App\Services\Interfaces;

use App\Http\Requests\GamePaginationRequest;
use Illuminate\Http\JsonResponse;

interface IGamesService
{
    public function index(GamePaginationRequest $request):JsonResponse;
    public function show(string $id):JsonResponse;

}
