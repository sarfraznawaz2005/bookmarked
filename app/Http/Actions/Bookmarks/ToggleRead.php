<?php

namespace App\Http\Actions\Bookmarks;

use App\Bookmark;
use Sarfraznawaz2005\Actions\Action;

class ToggleRead extends Action
{
    public function __invoke(Bookmark $bookmark)
    {
        $bookmark->read = !$bookmark->read;

        if ($this->update($bookmark)) {
            return flashBack(static::MESSAGE_UPDATE, 'success');
        }

        return flashBackErrors($bookmark->errors());
    }
}
