<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use App\Http\Requests\GamesListsPivotRequest;
use App\Services\Interfaces\IGameListPivotService;

class GamesListsPivotController extends Controller
{
    public function __construct(protected IGameListPivotService $service)
    {
    }

    public function index(GamesListsPivotRequest $request)
    {
        return $this->service->index($request);
    }
}
