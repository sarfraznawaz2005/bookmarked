<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'url',
        'thumbnail',
        'read',
    ];

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
