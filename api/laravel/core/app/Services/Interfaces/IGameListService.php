<?php

namespace App\Services\Interfaces;

use App\Http\Requests\GameListRequest;

interface IGameListService
{
    public function addGameToList(GameListRequest $request);
    public function removeGameFromList(GameListRequest $request);
    public function deleteList(GameListRequest $request);
    public function createList(GameListRequest $request);
}
