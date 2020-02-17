<?php

use App\Http\Actions\Bookmarks\DestroyBookmark;
use App\Http\Actions\Bookmarks\EditBookmark;
use App\Http\Actions\Bookmarks\GetUrlTitle;
use App\Http\Actions\Bookmarks\StoreBookmark;
use App\Http\Actions\Bookmarks\ToggleRead;
use App\Http\Actions\Bookmarks\UpdateBookmark;
use App\Http\Actions\Bookmarks\BookmarkTable;
use App\Http\Actions\Folders\DestroyFolder;
use App\Http\Actions\Folders\EditFolder;
use App\Http\Actions\Folders\FolderBoomarks;
use App\Http\Actions\Folders\FolderBoomarkTable;
use App\Http\Actions\Folders\FolderTable;
use App\Http\Actions\Folders\IndexFolder;
use App\Http\Actions\Folders\StoreFolder;
use App\Http\Actions\Folders\UpdateFolder;
use App\Http\Actions\IndexHome;
use App\Http\Actions\IndexSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => ['auth', 'verified']], static function () {
    Route::group(['namespace' => '\\'], static function () {

        Route::get('{url}', IndexHome::class)->where(['url' => '/|home|'])->name('home');

        // folders
        Route::get('folders', IndexFolder::class)->name('folders.index');
        Route::post('folders', StoreFolder::class)->name('folders.store');
        Route::get('folders/{folder}', EditFolder::class)->name('folders.edit');
        Route::put('folders/{folder}', UpdateFolder::class)->name('folders.update');
        Route::delete('folders/{folder}', DestroyFolder::class)->name('folders.destroy');
        Route::get('folders_table', FolderTable::class)->name('folders.table');
        Route::get('folders_bookmarks/{folder}', FolderBoomarks::class)->name('folders.bookmarks');
        Route::get('folder_bookmarks_table', FolderBoomarkTable::class)->name('folders.bookmarks.table');

        // bookmarks
        Route::post('bookmarks', StoreBookmark::class)->name('bookmarks.store');
        Route::get('bookmarks/{bookmark}', EditBookmark::class)->name('bookmarks.edit');
        Route::put('bookmarks/{bookmark}', UpdateBookmark::class)->name('bookmarks.update');
        Route::delete('bookmarks/{bookmark}', DestroyBookmark::class)->name('bookmarks.destroy');
        Route::get('get_url_title', GetUrlTitle::class)->name('bookmarks.get.title');
        Route::get('bookmarks_table', BookmarkTable::class)->name('bookmarks.table');
        Route::get('toggle_read/{bookmark}', ToggleRead::class)->name('bookmarks.toggle_read');

        // settings
        Route::get('settings', IndexSettings::class)->name('settings');
    });
});