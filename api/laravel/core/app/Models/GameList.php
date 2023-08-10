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
        'list_type_id',
        'is_delitable'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function listType()
    {
        return $this->belongsTo(ListType::class);
    }
    public function games()
    {
        return $this->belongsToMany(Game::class,'game_list', 'list_id', 'game_id');
    }
}
