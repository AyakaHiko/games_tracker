<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use App\Http\Requests\GameListApi\CreateGameListRequest;
use App\Http\Requests\GameListApi\GameListRequest;
use App\Http\Requests\GameListApi\RemoveGameListRequest;
use App\Http\Requests\GetGameListRequest;
use App\Services\Interfaces\IGameListService;
use Illuminate\Http\JsonResponse;

class GameListController extends Controller
{
    public function __construct(protected IGameListService $gameListService)
    {
    }
    public function getGameList(GetGameListRequest $request)
    {
        return $this->gameListService->getGameList($request);
    }
    public function getGameListDetails(GetGameListRequest $request)
    {
        return $this->gameListService->getGameListDetails($request);
    }

    public function addGameToList(GameListRequest $request)
    {
        return $this->gameListService->addGameToList($request);
    }

    public function removeGameFromList(GameListRequest $request)
    {
        return $this->gameListService->removeGameFromList($request);
    }

    public function deleteList(RemoveGameListRequest $request)
    {
        return $this->gameListService->deleteList($request);
    }

    public function createList(CreateGameListRequest $request)
    {
        return $this->gameListService->createList($request);
    }

}
