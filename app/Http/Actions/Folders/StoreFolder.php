<?php

namespace App\Http\Actions\Folders;

use App\Folder;
use Illuminate\Http\Request;
use Sarfraznawaz2005\Actions\Action;

class StoreFolder extends Action
{
    /**
     * Define any validation rules.
     */
    protected $rules = ['name' => 'required|unique:folders'];

    public function transform(Request $request): array
    {
        return [
            'user_id' => $request->user()->id
        ];
    }

    /**
     * Perform the action.
     *
     * @param Folder $folder
     * @return mixed
     */
    public function __invoke(Folder $folder)
    {
        if ($this->create($folder)) {
            return flashBack(static::MESSAGE_CREATE, 'success');
        }

        return flashBackErrors($folder->errors());
    }
}
