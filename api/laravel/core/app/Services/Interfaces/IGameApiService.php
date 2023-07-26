<?php

namespace App\Services\Interfaces;

interface IGameApiService
{
    public function updateGamesDatabase();
    public function updateGenresDatabase();
    public function updateDevelopersDatabase();
    public function updateGameDetailsDatabase($id);

}
