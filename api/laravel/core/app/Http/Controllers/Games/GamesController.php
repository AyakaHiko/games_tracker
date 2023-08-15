<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use App\Http\Requests\GamePaginationRequest;

use App\Services\Interfaces\IGamesApiService;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Validation\ValidationException;

class GamesController extends Controller
{
    public function __construct(protected IGamesApiService $gamesService)
    {
    }
    public function index(GamePaginationRequest $request)
    {
        try {
            return $this->gamesService->index($request);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (RequestException $e) {
            return response()->json(['error' => 'Failed to fetch games.'], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $response = $this->gamesService->show($id);
            return response()->json($response);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (RequestException $e) {
            return response()->json(['error' => 'Failed to fetch game details.'], 500);
        }
    }
}
