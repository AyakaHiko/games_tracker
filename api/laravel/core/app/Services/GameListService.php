<?php

namespace App\Services;

use App\Http\Requests\GameListApi\CreateGameListRequest;
use App\Http\Requests\GameListApi\GameListRequest;
use App\Http\Requests\GameListApi\RemoveGameListRequest;
use App\Models\Game;
use App\Models\GameList;
use App\Services\Interfaces\IGameListService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GameListService implements IGameListService
{
        public function addGameToList(GameListRequest $request)
        {
            $validatedData = $request->validated();
            $gameId = $validatedData['game_id'];
            $listId = $validatedData['list_id'];

            try {
                $gameList = GameList::findOrFail($listId);
                $game = Game::findOrFail($gameId);

                $gameList->games()->attach($game);

                return response()->json(['message' => 'Game added to the list successfully']);
            } catch (ModelNotFoundException $e) {
                return response()->json(['message' => 'Game or list not found'], 404);
            }
        }

    public function removeGameFromList(GameListRequest $request)
    {
        $validatedData = $request->validated();
        $gameId = $validatedData['game_id'];
        $listId = $validatedData['list_id'];

        try {
            $gameList = GameList::findOrFail($listId);
            $game = Game::findOrFail($gameId);

            $gameList->games()->detach($game);

            return response()->json(['message' => 'Game removed from the list successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Game or list not found'], 404);
        }    }

    public function deleteList(RemoveGameListRequest $request)
    {
        $validatedData = $request->validated();
        $listId = $validatedData['list_id'];

        try {
            $gameList = GameList::findOrFail($listId);
            $gameList->delete();

            return response()->json(['message' => 'List deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'List not found'], 404);
        }
    }

    public function createList(CreateGameListRequest $request)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();
            $user = Auth::user();

            GameList::create([
                'name' => $validatedData['list_name'],
                'user_id' => $user->id,
            ]);

            DB::commit();

            return response()->json(['message' => 'List created successfully']);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Error occurred. List creation failed.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
