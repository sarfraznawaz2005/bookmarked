<?php

namespace App\Http\Actions\Bookmarks;

use App\Bookmark;
use App\Folder;
use Sarfraznawaz2005\Actions\Action;

class EditBookmark extends Action
{
    public function __invoke(Bookmark $bookmark, Folder $folder)
    {
        $folders = $folder->where('user_id', auth()->user()->id)->get()->sortBy('name');

        return view('edit', compact('bookmark', 'folders'));
    }
}
