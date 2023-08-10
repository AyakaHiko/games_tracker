<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListType extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function lists()
    {
        return $this->hasMany(GameList::class, 'list_type_id');
    }
}
