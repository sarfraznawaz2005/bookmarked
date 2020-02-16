<?php

namespace App\Http\Actions\Folders;

use App\Folder;
use Illuminate\Support\Str;
use Sarfraznawaz2005\Actions\Action;

class UpdateFolder extends Action
{
    /**
     * Define any validation rules.
     */
    protected $rules = ['name' => 'required:'];

    /**
     * Perform the action.
     *
     * @param Folder $folder
     * @return mixed
     */
    public function __invoke(Folder $folder)
    {
        try {
            if ($this->update($folder)) {
                return flashBack(static::MESSAGE_UPDATE, 'success');
            }

            return flashBackErrors($folder->errors());
        } catch (\Exception $e) {
            if (Str::contains($e->getMessage(), 'Duplicate')) {
                return flashBackErrors(['The name has already been taken.']);
            }

            return flashBackErrors($folder->errors());
        }
    }
}
