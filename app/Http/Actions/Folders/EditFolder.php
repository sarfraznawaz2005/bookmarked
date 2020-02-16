<?php

namespace App\Http\Actions\Folders;

use App\Folder;
use Sarfraznawaz2005\Actions\Action;

class EditFolder extends Action
{
    public function __invoke(Folder $folder)
    {
        return view('pages.folders.edit', compact('folder'));
    }
}
