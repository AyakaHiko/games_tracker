<?php

namespace App\Services\Interfaces;

use App\Http\Requests\GameListApi\CreateGameListRequest;
use App\Http\Requests\GameListApi\GameListRequest;
use App\Http\Requests\GameListApi\RemoveGameListRequest;

interface IGameListService
{
    public function addGameToList(GameListRequest $request);
    public function removeGameFromList(GameListRequest $request);
    public function deleteList(RemoveGameListRequest $request);
    public function createList(CreateGameListRequest $request);
}
