<?php

namespace App\Http\Actions;

use App\Folder;
use Sarfraznawaz2005\Actions\Action;

class IndexHome extends Action
{
    public function __invoke(Folder $folder)
    {
        $folders = $folder->where('user_id', auth()->user()->id)->get()->sortBy('name');

        return view('home', compact('folders'));
    }
}
