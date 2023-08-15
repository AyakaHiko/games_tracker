<?php

namespace App\Services;

use App\Http\Requests\GamesListsPivotRequest;
use App\Models\GamesListsPivot;
use App\Services\Interfaces\IGameListPivotService;
use Illuminate\Support\Facades\Log;

class GameListPivotService implements IGameListPivotService
{
    public function index(GamesListsPivotRequest $request)
    {
        try {
            $query = GamesListsPivot::query();
            if ($request->has('game_id')) {
                $query->where('game_id', $request->game_id);
            }

            if ($request->has('list_id')) {
                $query->where('list_id', $request->list_id);
            }

            $results = $query->get();

            return response()->json($results);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching data.'], 500);
        }    }
}
