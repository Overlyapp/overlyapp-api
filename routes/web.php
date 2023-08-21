<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    return view('welcome');
});

Route::prefix('overly')->group(function ()
{
    Route::any('/marker/create', 'App\Http\Controllers\MarkerController@create');
    Route::any('/marker/update', 'App\Http\Controllers\MarkerController@update');
    Route::any('/upload/marker/video', 'App\Http\Controllers\MarkerUploadController@video');
});
