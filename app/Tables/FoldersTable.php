<?php

namespace App\Tables;

use App\Folder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class FoldersTable extends Table
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
            'name',
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
        return (new Folder())::with('bookmarks')->where('user_id', auth()->user()->id);
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
            $action .= listingDeleteButton(route('folders.destroy', $row['id']), 'Folder');

            $data['Name'] = sprintf('<a href="%1$s">%2$s</a>', route('folders.bookmarks', $row['id']), $row['name']);

            $data['Bookmarks'] = badge(count($row['bookmarks']));

            $data['Created'] = sprintf("<span title='$row[created_at]'>%s</span>",
                Carbon::parse($row['created_at'])->diffForHumans());

            $data['Action'] = center($action);

            $transformed[] = $data;
        }

        return $transformed;
    }
}
