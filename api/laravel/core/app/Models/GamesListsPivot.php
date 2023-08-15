<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GamesListsPivot extends Model
{
    use HasFactory;
    protected $table = 'game_list';

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function list()
    {
        return $this->belongsTo(GameList::class);
    }
}
