<?php

namespace App\Http\Actions\Folders;

use App\Folder;
use Sarfraznawaz2005\Actions\Action;

class DestroyFolder extends Action
{
    public function __invoke(Folder $folder)
    {
        if ($this->delete($folder)) {
            return flashBack(static::MESSAGE_DELETE, 'success');
        }

        return flashBackErrors($folder->errors());
    }
}
