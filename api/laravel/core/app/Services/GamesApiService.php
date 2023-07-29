<?php

namespace App\Services;

use App\Http\Requests\GamePaginationRequest;
use App\Models\Game;
use App\Models\GameDetails;
use App\Services\Interfaces\IGamesApiService;
use App\Services\Interfaces\IHttpService;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;

class GamesApiService implements IGamesApiService
{
    public function __construct(protected IHttpService $httpService)
    {
    }


    public function index(GamePaginationRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $page = $validatedData['page'] ?? 1;
        $pageSize = $validatedData['page_size'] ?? 10;
        $searchQuery = $request['search'] ?? '';
        try {
            $cacheKey = 'games_page_' . $page . '_size_' . $pageSize . '_search_' . $searchQuery;

            if (Cache::has($cacheKey)) {
                $result = Cache::get($cacheKey);
            } else {
                $result = Game::query()
                    ->orderByDesc('popularity')
                    ->where('name', 'like', '%' . $searchQuery . '%')
                    ->with('genres')
                    ->paginate(perPage: $pageSize, page: $page);

                Cache::put($cacheKey, $result, now()->addMinutes(30));
            }

            return response()->json([
                'result' => $result
            ], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (RequestException $e) {
            return response()->json(['error' => 'Failed to fetch games.'], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $game = GameDetails::find($id);
            if(!$game)
            {
                $game = (new GamesUpdateService)->updateGameDetailsDatabase($id);
            }
            return response()->json($game);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (RequestException $e) {
            return response()->json(['error' => 'Failed to fetch game details.'], 500);
        }
    }
}
