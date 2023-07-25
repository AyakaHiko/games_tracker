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
        return $this->belongsToMany(Genre::class);
    }
}
