<?php

namespace App\Tables;

use App\Bookmark;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class FolderBookmarksTable extends Table
{
    public $folderId = 0;

    /**
     * Columns to be shown in table.
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            'id',
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
        return (new Bookmark())
            ->where('user_id', auth()->user()->id)
            ->where('folder_id', session('folder_id'));
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

            $action = $this->listingReadButton(route('bookmarks.toggle_read', $row['id']));
            $action .= listingDeleteButton(route('bookmarks.destroy', $row['id']), 'Bookmark');

            $data['Title'] = sprintf("<a title='$row[title]' target='_blank' href='$row[url]'>%s</a>",
                Str::limit($row['title'], 70));

            $data['Description'] = sprintf("<span title='$row[description]'>%s</span>",
                Str::limit($row['description'], 30));

            $data['Read'] = label($row['read'], $row['read'] === 1 ? 'success' : 'warning');

            $data['Created'] = sprintf("<span title='$row[created_at]'>%s</span>",
                Carbon::parse($row['created_at'])->diffForHumans());

            $data['Action'] = center($action);

            $transformed[] = $data;
        }

        return $transformed;
    }

    protected function listingReadButton($link, $title = 'Toggle Read'): string
    {
        $html = <<< HTML
    <a title="$title" style="text-decoration: none;" href="$link">
        <b class="btn btn-success btn-sm fa fa-book"></b>
    </a>
HTML;

        return $html;
    }

    /**
     * Gets order field with key being field name and value being direction.
     *
     * @return array
     */
    public function orderField(): array
    {
        return ['id' => 'desc'];
    }
}
