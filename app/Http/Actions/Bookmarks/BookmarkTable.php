<?php

namespace App\Http\Actions\Bookmarks;

use App\Tables\BookmarksTable;
use Sarfraznawaz2005\Actions\Action;

class BookmarkTable extends Action
{
    public function __invoke(BookmarksTable $table)
    {
        return $table->getData();
    }
}
