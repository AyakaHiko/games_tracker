<?php

namespace App\Services\Interfaces;

interface IGameUpdateService
{
    public function updateGamesDatabase();
    public function updateGenresDatabase();
    public function updateDevelopersDatabase();
    public function updateGameDetailsDatabase($id);

}
