<?php

namespace App\Http\Actions;

use App\Bookmark;
use Sarfraznawaz2005\Actions\Action;

class IndexHome extends Action
{
    public function __invoke(Bookmark $bookmark)
    {
        return view('home');
    }
}
