<?php

namespace App\Http\Actions\Bookmarks;

use App\Bookmark;
use App\Tag;
use Illuminate\Http\Request;
use Sarfraznawaz2005\Actions\Action;

class StoreBookmark extends Action
{
    /**
     * Define any validation rules.
     */
    protected $rules = [
        'url' => 'required',
        'title' => 'required',
    ];

    public function transform(Request $request): array
    {
        return [
            'user_id' => $request->user()->id
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
        if ($this->create($bookmark)) {

            foreach (\request()->tags as $tag) {
                $tag = new Tag(['tag' => $tag]);
                $bookmark->tags()->save($tag);
            }

            return flashBack(static::MESSAGE_CREATE, 'success');
        }

        return flashBackErrors($bookmark->errors());
    }
}
