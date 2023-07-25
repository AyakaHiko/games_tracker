<?php

namespace App\Http\Controllers\Games;
    use App\Jobs\Games\UpdateGameDetailsList;
    use App\Jobs\Games\UpdateGameList;
    use App\Jobs\Games\UpdateGenresList;
    use App\Services\GamesApiService;
    use Illuminate\Support\Facades\Log;

    class CacheGameController
{
        public function UpdateGames(){
            UpdateGameList::dispatch(new GamesApiService());
        }
        public function UpdateGenres(){
            UpdateGenresList::dispatch(new GamesApiService());
        }
        public function UpdateGameDetails($id){
            UpdateGameDetailsList::dispatch($id);
        }


    }
