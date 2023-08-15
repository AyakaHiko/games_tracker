<?php

namespace App\Services\Interfaces;

use App\Http\Requests\GameListApi\CreateGameListRequest;
use App\Http\Requests\GameListApi\GameListRequest;
use App\Http\Requests\GameListApi\RemoveGameListRequest;
use App\Http\Requests\GetGameListsRequest;

interface IGameListService
{
    public function addGameToList(GameListRequest $request);
    public function removeGameFromList(GameListRequest $request);
    public function deleteList(RemoveGameListRequest $request);
    public function createList(CreateGameListRequest $request);
    public function getGameLists(GetGameListsRequest $request);
    public function getGameList(int $id);

    public function getGameListsDetails(GetGameListsRequest $request);
    public function getGameListDetails(int $id);

}
