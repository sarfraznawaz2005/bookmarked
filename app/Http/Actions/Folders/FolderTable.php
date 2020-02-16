<?php

namespace App\Http\Actions\Folders;

use App\Tables\FoldersTable;
use Sarfraznawaz2005\Actions\Action;

class FolderTable extends Action
{
    public function __invoke(FoldersTable $table)
    {
        return $table->getData();
    }
}
