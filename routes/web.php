<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('auth')->name('welcome');

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);
