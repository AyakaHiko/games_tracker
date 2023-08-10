<?php

namespace App\Services;

use App\Http\Requests\GameListApi\CreateGameListRequest;
use App\Http\Requests\GameListApi\GameListRequest;
use App\Http\Requests\GameListApi\RemoveGameListRequest;
use App\Http\Requests\GetGameListRequest;
use App\Models\Game;
use App\Models\GameList;
use App\Models\ListType;
use App\Services\Interfaces\IGameListService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GameListService implements IGameListService
{
    public function getGameList(GetGameListRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $userId = $validatedData['user_id'];

            $gameListQuery = GameList::where('user_id', $userId);

            if (isset($validatedData['list_type'])) {
                $listType = ListType::where('name', $validatedData['list_type'])->first();

                if ($listType) {
                    $gameListQuery->where('list_type_id', $listType->id);
                }
            }

            if (isset($validatedData['list_name'])) {
                $gameListQuery->where('list_name', 'like', '%' . $validatedData['list_name'] . '%');
            }

            $gameList = $gameListQuery->get();

            return response()->json(['gamelist' => $gameList], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
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
        }
    }

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
