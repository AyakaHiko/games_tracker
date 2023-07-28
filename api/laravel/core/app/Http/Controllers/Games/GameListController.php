<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use App\Http\Requests\GameListRequest;
use App\Services\GameListService;
use App\Services\Interfaces\IGameListService;
use Illuminate\Http\Request;

class GameListController extends Controller
{
    public function __construct(protected IGameListService $gameListService)
    {
    }
    public function addGameToList(GameListRequest $request)
    {
    }

    public function removeGameFromList(GameListRequest $request)
    {
    }

}
