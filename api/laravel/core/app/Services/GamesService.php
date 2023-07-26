<?php

namespace App\Services;

use App\Http\Requests\GamePaginationRequest;
use App\Models\Game;
use App\Services\Interfaces\IGamesService;
use App\Services\Interfaces\IHttpService;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class GamesService implements IGamesService
{
    public function __construct(protected IHttpService $httpService)
    {
    }


    public function index(GamePaginationRequest $request): \Illuminate\Http\JsonResponse
    {
        Log::debug($request);

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

    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        try {
            $response = $this->httpService->makeRequest('GET', $this->url . '/games/' . $id, params: [
                'key' => $this->apiKey,
            ]);
            return response()->json($response);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (RequestException $e) {
            return response()->json(['error' => 'Failed to fetch game details.'], 500);
        }
    }
}
