<?php

namespace App\Http\Actions\Bookmarks;

use App\Bookmark;
use Illuminate\Http\Request;
use Sarfraznawaz2005\Actions\Action;

class UpdateBookmark extends Action
{
    /**
     * Define any validation rules.
     */
    protected $rules = [
        'url' => 'required',
        'title' => 'required',
        'folder_id' => 'required',
    ];

    public function transform(Request $request): array
    {
        return [
            'url' => trim(rtrim($request->url, '/')),
            'user_id' => $request->user()->id,
            'read' => $request->has('read') ? '1' : '0',
            'title' => normalizTitle($request->title),
        ];
    }

    /**
     * Perform the action.
     *
     * @param Bookmark $bookmark
     * @return mixed
     */
    public function __invoke(Bookmark $bookmark)
    {
        if ($this->update($bookmark)) {
            return flashBack(static::MESSAGE_UPDATE, 'success');
        }

        return flashBackErrors($bookmark->errors());
    }
}
