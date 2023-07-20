<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\IHttpService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class GamesController extends Controller
{
    protected string $apiKey;
    protected string $url;
    public function __construct(protected IHttpService $httpService)
    {
        $apiKey = env('RAWG_API_KEY');
        $url = env('RAWG_API_URL');
    }

    public function index() {

        try {
            return $this->httpService->makeRequest('GET',$this->url.'/games',params: [
                    'key' => $this->apiKey,
                    'page' => 3,
                    'page_size' => 1]
            );
        } catch (RequestException $e) {
            return response()->json(['error' => 'Failed to fetch games.'], 500);
        }
    }


}
