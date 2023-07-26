<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;
    protected $fillable = [
        'id' ,
        'slug',
        'name' ,
        'image_background',
    ];
    public function games()
    {
        return $this->belongsToMany(GameDetails::class,'developers_game_details', 'developer_id', 'game_details_id');
    }
}
