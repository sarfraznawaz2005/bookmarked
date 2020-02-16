<?php

namespace App\Tables;

use App\Bookmark;
use Illuminate\Database\Eloquent\Builder;

class BookmarksTable extends Table
{
    /**
     * Columns to be shown in table.
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            'id',
            'folder_id',
            'title',
            'description',
            'url',
            'read',
            'created_at',
        ];
    }

    /**
     * Searchable columns in table
     *
     * @return array
     */
    public function searchColumns(): array
    {
        return $this->columns();
    }

    /**
     * Table Query
     *
     * @return Builder
     */
    public function builder(): Builder
    {
        return (new Bookmark())::with('folder')->where('user_id', auth()->user()->id);
    }

    /**
     * Transform data as we need.
     *
     * @param array $rows
     * @return array
     */
    public function transform(array $rows): array
    {
        $transformed = [];

        foreach ($rows as $row) {
            $action = listingEditButton(route('folders.edit', $row['id']));
            $action .= listingDeleteButton(route('bookmarks.destroy', $row['id']), 'Bookmark');

            $data['Title'] = $row['title'];
            $data['Folder'] = $row['folder']['name'];
            $data['Description'] = $row['description'];
            $data['Read'] = $row['read'];
            $data['Created'] = $row['created_at'];
            $data['Action'] = center($action);

            $transformed[] = $data;
        }

        return $transformed;
    }
}
