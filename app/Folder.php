<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Folder extends Model
{
    protected $fillable = ['user_id', 'name'];

    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }
}
