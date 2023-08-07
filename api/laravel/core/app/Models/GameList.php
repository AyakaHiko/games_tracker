<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameList extends Model
{
    use HasFactory;

    protected $table = 'lists';
    protected $fillable = [
        'name',
        'user_id',
    ];
    public function games()
    {
        return $this->belongsToMany(Game::class,'game_list', 'list_id', 'game_id');
    }
}
