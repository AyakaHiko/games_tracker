<?php

namespace App\Services\Interfaces;

use App\Http\Requests\GamesListsPivotRequest;

interface IGameListPivotService
{
    public function index(GamesListsPivotRequest $request);
}
