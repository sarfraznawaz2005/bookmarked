<?php

use App\Http\Actions\Bookmarks\DestroyBookmark;
use App\Http\Actions\Bookmarks\StoreBookmark;
use App\Http\Actions\Bookmarks\UpdateBookmark;
use App\Http\Actions\Folders\DestroyFolder;
use App\Http\Actions\Folders\IndexFolder;
use App\Http\Actions\Folders\StoreFolder;
use App\Http\Actions\Folders\UpdateFolder;
use App\Http\Actions\IndexHome;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => ['auth', 'verified']], static function () {
    Route::group(['namespace' => '\\'], static function () {

        Route::get('{url}', IndexHome::class)->where(['url' => '/|home|'])->name('home');

        // folders
        Route::get('folders', IndexFolder::class)->name('folders.index');
        Route::post('folders', StoreFolder::class)->name('folders.store');
        Route::put('folders/{folder}', UpdateFolder::class)->name('folders.update');
        Route::delete('folders/{folder}', DestroyFolder::class)->name('folders.destroy');

        // bookmarks
        Route::post('bookmarks', StoreBookmark::class)->name('bookmarks.store');
        Route::put('bookmarks/{bookmark}', UpdateBookmark::class)->name('bookmarks.update');
        Route::delete('bookmarks/{bookmark}', DestroyBookmark::class)->name('bookmarks.destroy');

    });
});