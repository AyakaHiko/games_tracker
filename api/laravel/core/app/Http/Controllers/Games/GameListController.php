<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use App\Http\Requests\GameListApi\CreateGameListRequest;
use App\Http\Requests\GameListApi\GameListRequest;
use App\Http\Requests\GameListApi\RemoveGameListRequest;
use App\Http\Requests\GetGameListsRequest;
use App\Services\Interfaces\IGameListService;
use Illuminate\Http\JsonResponse;

class GameListController extends Controller
{
    public function __construct(protected IGameListService $gameListService)
    {
    }
    public function getGameLists(GetGameListsRequest $request)
    {
        return $this->gameListService->getGameLists($request);
    }
    public function getGameListsDetails(GetGameListsRequest $request)
    {
        return $this->gameListService->getGameListsDetails($request);
    }
    public function getGameList(int $id)
    {
        return $this->gameListService->getGameList($id);
    }
    public function getGameListDetails(int $id)
    {
        return $this->gameListService->getGameListDetails($id);
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
