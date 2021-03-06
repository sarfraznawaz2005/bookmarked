<?php

namespace App\Http\Actions\Bookmarks;

use App\Bookmark;
use Sarfraznawaz2005\Actions\Action;

class DestroyBookmark extends Action
{
    public function __invoke(Bookmark $bookmark)
    {
        if ($this->delete($bookmark)) {
            return flashBack(static::MESSAGE_DELETE, 'success');
        }

        return flashBackErrors($bookmark->errors());
    }
}
