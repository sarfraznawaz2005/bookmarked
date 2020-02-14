<?php

use App\Http\Actions\IndexHome;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => ['auth', 'verified']], static function () {
    Route::group(['namespace' => '\\'], static function () {

        Route::get('{url}', IndexHome::class)->where(['url' => '/|home|'])->name('home');

    });
});