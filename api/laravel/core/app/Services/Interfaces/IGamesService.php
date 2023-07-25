<?php

namespace App\Services\Interfaces;

use Illuminate\Http\JsonResponse;

interface IGamesService
{
    public function index($page=1, $pageSize=10):JsonResponse;
    public function show(string $id):JsonResponse;

}
