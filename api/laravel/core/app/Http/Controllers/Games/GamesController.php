<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use App\Http\Requests\GamePaginationRequest;
use App\Http\Requests\GameRequest;
use App\Services\Interfaces\IHttpService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class GamesController extends Controller
{
    protected $apiKey;
    protected $url;

    public function __construct(protected IHttpService $httpService)
    {
        $this->apiKey = env('RAWG_API_KEY');
        $this->url = env('RAWG_API_URL');
    }

    public function index(GamePaginationRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $page = $validatedData['page'] ?? 1;
            $pageSize = $validatedData['page_size'] ?? 10;
            return $this->httpService->makeRequest('GET', $this->url . '/games', params: [
                'key' => $this->apiKey,
                'page' => $page,
                'page_size' => $pageSize,
            ]
            );
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (RequestException $e) {
            return response()->json(['error' => 'Failed to fetch games.'], 500);
        }
    }

    public function show(string $id)
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
