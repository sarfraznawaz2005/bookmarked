<?php

namespace App\Http\Actions\Folders;

use App\Folder;
use Sarfraznawaz2005\Actions\Action;

class IndexFolder extends Action
{
    public function __invoke(Folder $folder)
    {
        return view('pages.folders.index');
    }
}
