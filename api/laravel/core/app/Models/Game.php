<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'slug' ,
        'name',
        'released',
        'background_image',
        'rating' ,
        'metacritic',
        'popularity',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class,'genres_games', 'game_id', 'genre_id');
    }
    public function lists()
    {
        return $this->belongsToMany(GameList::class,'game_list', 'game_id', 'list_id');
    }
}
