<?php

namespace App\Services;

use App\Models\Developer;
use App\Models\Game;
use App\Models\GameDetails;
use App\Models\Genre;
use App\Services\Interfaces\IGameUpdateService;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class GamesUpdateService implements IGameUpdateService
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
            $url = $this->url . '/games?key=' . $this->apiKey;
            while ($url != null) {
                $data = Http::get($url);
                $url = $data['next'];
                if ($data['results']) {
                    foreach ($data['results'] as $game) {
                        $gameId = $game['id'];
                        $existingGame = Game::find($gameId);
                        if ($existingGame) {
                            $fieldToUpdate = [
                                'popularity' => $game['added'],
                            ];
                            $existingGame->update($fieldToUpdate);
                            continue;
                        }
                        $newGame = Game::create([
                            'id' => $gameId,
                            'slug' => $game['slug'],
                            'name' => $game['name'],
                            'released' => $game['released'],
                            'background_image' => $game['background_image'],
                            'rating' => $game['rating'],
                            'metacritic' => $game['metacritic'],
                            'popularity' => $game['added'],
                        ]);
                        $genres = $game['genres'];
                        $genreIds = collect($genres)->pluck('id')->all();
                        $newGame->genres()->attach($genreIds);
                        $newGame->save();
                    }
                }
            }
        } catch (ValidationException|RequestException $e) {
            Log::error($e);
        }
    }

    public function updateGenresDatabase(): void
    {
        try {
            $url = $this->url . '/genres?key=' . $this->apiKey;
            while ($url != null) {
                $data = Http::get($url);
                $url = $data['next'];
                if ($data['results']) {
                    foreach ($data['results'] as $genre) {
                        if (Genre::where('id', $genre['id'])->exists()) {
                            return;
                        }
                        $newGenre = Genre::create([
                            'id' => $genre['id'],
                            'slug' => $genre['slug'],
                            'name' => $genre['name'],
                            'background_image' => $genre['image_background'],
                        ]);
                        $newGenre->save();
                    }
                }
            };
        } catch (ValidationException|RequestException $e) {
            Log::error($e);
        }
    }

    public function updateGameDetailsDatabase($id)
    {
        $game = GameDetails::find($id);
        if ($game)
            return $game;
        try {

            $url = $this->url . '/games/' . $id;
            $data = $this->getData($url);
            $newDetails = GameDetails::create([
                'id' => $data['id'],
                'slug' => $data['slug'],
                'name_original' => $data['name_original'],
                'description' => $data['description'],
                'background_image_additional' => $data['background_image_additional'],
                'website' => $data['website'],
            ]);
            $newDetails->game()->associate(Game::find($id));
            $newDetails->save();
            return $newDetails;
        } catch (ValidationException|RequestException $e) {
            Log::error($e);
        }
    }

    public function updateDevelopersDatabase()
    {
        try {
            $url = $this->url . '/developers?key=' . $this->apiKey;
            while ($url != null) {
                $data = Http::get($url);
                $url = $data['next'];
                if ($data['results']) {
                    foreach ($data['results'] as $developer) {
                        if (Developer::where('id', $developer['id'])->exists()) continue;
                        $newDeveloper = Developer::create([
                            'id' => $developer['id'],
                            'slug' => $developer['slug'],
                            'name' => $developer['name'],
                            'image_background' => $developer['image_background'],
                        ]);
                        $newDeveloper->save();
                    }
                }
            };
        } catch (ValidationException|RequestException $e) {
            Log::error($e);
        }
    }
}
