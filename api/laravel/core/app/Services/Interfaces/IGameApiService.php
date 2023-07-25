<?php

namespace App\Services\Interfaces;

interface IGameApiService
{
    public function updateGamesDatabase();
    public function updateGenresDatabase();
    public function updateGameDetailsDatabase($id);

}
