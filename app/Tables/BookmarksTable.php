<?php

namespace App\Tables;

use App\Bookmark;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

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

            $action = $this->listingReadButton(route('folders.edit', $row['id']));
            $action .= listingEditButton(route('folders.edit', $row['id']));
            $action .= listingDeleteButton(route('bookmarks.destroy', $row['id']), 'Bookmark');

            $data['Title'] = sprintf("<a title='$row[title]' target='_blank' href='$row[url]'>%s</a>",
                Str::limit($row['title'], 50));

            $data['Folder'] = sprintf('<a href="#">%s</a>', $row['folder']['name']);

            $data['Description'] = sprintf("<span title='$row[description]'>%s</span>",
                Str::limit($row['description'], 30));

            $data['Read'] = label($row['read'], $row['read'] === 1 ? 'success' : 'warning');
            $data['Created'] = $row['created_at'];
            $data['Action'] = center($action);

            $transformed[] = $data;
        }

        return $transformed;
    }

    protected function listingReadButton($link, $title = 'Mark Read'): string
    {
        $html = <<< HTML
    <a title="$title" style="text-decoration: none;" href="$link">
        <b class="btn btn-success btn-sm fa fa-book"></b>
    </a>
HTML;

        return $html;
    }
}
