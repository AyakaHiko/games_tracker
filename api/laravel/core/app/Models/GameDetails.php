<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'slug' ,
        'name_original',
        'description',
        'background_image_additional',
        'website' ,
    ];
    public function game()
    {
        return $this->belongsTo(Game::class, 'id');
    }
//    public function developers()
//    {
//        return $this->belongsToMany(Developer::class,'developers_game_details', 'game_details_id', 'developer_id');
//    }
}
