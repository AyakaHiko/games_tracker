<?php

namespace App\Services;

use App\Models\Game;
use App\Models\Genre;
use App\Services\Interfaces\IGameApiService;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class GamesApiService implements IGameApiService
{
    protected string $apiKey;
    protected string $url;

    public function __construct()
    {
        $this->apiKey = env('RAWG_API_KEY');
        $this->url = env('RAWG_API_URL');
    }

    /**
     * Execute the job.
     */
    protected function getData($url, $params = [])
    {
        $response = Http::get($url, [
                'key' => $this->apiKey,
            ] + $params);
        return $response->json();
    }

    public function updateGamesDatabase(): void
    {
        try {
            $url = $this->url . '/games';
            do {
                $data = $this->getData($url, [
                    'page_size' => 40,
                ]);
                $url = $data['next'];
                if (isset($data['results']) && is_array($data['results'])) {
                    foreach ($data['results'] as $game) {
                        if (Game::where('id', $game['id'])->exists())
                            return;
                        $newGame = Game::create([
                            'id' => $game['id'],
                            'slug' => $game['slug'],
                            'name' => $game['name'],
                            'released' => $game['released'],
                            'background_image' => $game['background_image'],
                            'rating' => $game['rating'],
                            'metacritic' => $game['metacritic'],
                            'popularity'=>$game['added'],
                        ]);
                        $genres = $game['genres'];
                        $genreIds = collect($genres)->pluck('id')->all();
                        $newGame->genres()->attach($genreIds);
                        $newGame->save();
                    }
                }
            } while ($url != null);
        } catch (ValidationException|RequestException $e) {
            Log::error($e);
        }
    }

    public function updateGenresDatabase()
    {
        try {
            $url = $this->url . '/genres';
            do {
                $data = $this->getData($url);
                $url = $data['next'];
                if (isset($data['results']) && is_array($data['results'])) {
                    foreach ($data['results'] as $genre) {
                        if (Genre::where('id', $genre['id'])->exists()) {
                            return;
                        }
                        $newGenre =  Genre::create([
                            'id' => $genre['id'],
                            'slug' => $genre['slug'],
                            'name' => $genre['name'],
                            'background_image' => $genre['image_background'],
                        ]);
                        $newGenre->save();
                    }
                }
            } while ($url != null);
        } catch (ValidationException|RequestException $e) {
            Log::error($e);
        }
    }

    public function updateGameDetailsDatabase($id)
    {

    }
}
