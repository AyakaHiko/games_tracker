<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use app\Http\Requests\GameListApi\GameListRequest;
use App\Services\Interfaces\IGameListService;

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
