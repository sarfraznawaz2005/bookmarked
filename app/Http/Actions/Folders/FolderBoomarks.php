<?php

namespace App\Http\Actions\Folders;

use App\Folder;
use Sarfraznawaz2005\Actions\Action;

class FolderBoomarks extends Action
{
    public function __invoke(Folder $folder)
    {
        session(['folder_id' => $folder->id]);

        return view('pages.folders.bookmarks', compact('folder'));
    }
}
