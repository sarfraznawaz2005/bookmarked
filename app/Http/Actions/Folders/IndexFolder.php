<?php

namespace App\Http\Actions\Folders;

use Sarfraznawaz2005\Actions\Action;

class IndexFolder extends Action
{
    public function __invoke()
    {
        return view('pages.folders.index');
    }
}
