<?php

namespace App\Http\Actions;

use Sarfraznawaz2005\Actions\Action;

class IndexHome extends Action
{
    public function __invoke()
    {
        return view('home');
    }
}
