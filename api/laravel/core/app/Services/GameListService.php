<?php

namespace App\Services;

use App\Http\Requests\GameListRequest;
use app\Services\Interfaces\IGameListService;

class GameListService implements IGameListService
{


        public function addGameToList(GameListRequest $request)
        {
            $validatedData = $request->validated();
            $gameId = $validatedData['game_id'];
            $listId = $validatedData['list_id'];

        }

    public function removeGameFromList(GameListRequest $request)
    {
        // TODO: Implement removeGameFromList() method.
    }

    public function deleteList(GameListRequest $request)
    {
        // TODO: Implement deleteList() method.
    }

    public function createList(GameListRequest $request)
    {
        // TODO: Implement createList() method.
    }
}
