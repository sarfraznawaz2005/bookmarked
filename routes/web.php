<?php

use App\Http\Actions\Bookmarks\DestroyBookmark;
use App\Http\Actions\Bookmarks\StoreBookmark;
use App\Http\Actions\Bookmarks\UpdateBookmark;
use App\Http\Actions\IndexHome;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => ['auth', 'verified']], static function () {
    Route::group(['namespace' => '\\'], static function () {

        Route::get('{url}', IndexHome::class)->where(['url' => '/|home|'])->name('home');

        // bookmarks
        Route::post('bookmarks', StoreBookmark::class)->name('bookmarks.store');
        Route::put('bookmarks/{bookmark}', UpdateBookmark::class)->name('bookmarks.update');
        Route::delete('bookmarks/{bookmark}', DestroyBookmark::class)->name('bookmarks.destroy');

    });
});