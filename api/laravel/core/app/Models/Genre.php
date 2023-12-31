<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $fillable = [
        'id' ,
        'slug',
        'name' ,
        'background_image',
    ];
    public function games()
    {
        return $this->belongsToMany(Game::class, 'genres_games', 'genre_id', 'game_id');
    }
}
