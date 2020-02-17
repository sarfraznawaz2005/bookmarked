<?php

namespace App\Http\Actions\Folders;

use App\Tables\FolderBookmarksTable;
use Sarfraznawaz2005\Actions\Action;

class FolderBoomarkTable extends Action
{
    public function __invoke(FolderBookmarksTable $table)
    {
        return $table->getData();
    }
}
