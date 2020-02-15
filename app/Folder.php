<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Folder extends Model
{
    protected $fillable = ['name'];

    public function folder(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }
}
