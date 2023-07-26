<?php

namespace App\Services;

use App\Models\Game;
use App\Services\Interfaces\IGamesService;
use App\Services\Interfaces\IHttpService;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Validation\ValidationException;

class GamesService implements IGamesService
{
    public function __construct(protected IHttpService $httpService)
    {}

    public function index($page=1, $pageSize=10): \Illuminate\Http\JsonResponse
    {
        try {
            $result = Game::query()
                ->orderByDesc('popularity')
                ->paginate(perPage: $pageSize, page: $page);
            return response()->json([
                'result'=>$result
            ],200);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (RequestException $e) {
            return response()->json(['error' => 'Failed to fetch games.'], 500);
        }
    }
    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        try {
            $response = $this->httpService->makeRequest('GET', $this->url . '/games/' . $id, params:[
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
