<?php

namespace App\Services;

use App\Services\Interfaces\IHttpService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class HttpService implements IHttpService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function makeRequest($method, $url, $headers = [], $params = [])
    {
        try {
            $response = $this->client->request($method, $url, [
                'headers' => $headers,
                'query' => $params,
            ]);
            $data = $response->getBody()->getContents();
            return json_decode($data, true);
        } catch (RequestException $e) {
            // Обработка ошибки при запросе API
            Log::error($e->getMessage());
            return null;
        }
    }
}
