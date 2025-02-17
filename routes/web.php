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
    return view('docs.index');
});

// Documentation routes
Route::prefix('docs')->group(function () {
    Route::get('/', function () {
        return view('docs.index');
    });
    
    Route::get('/movies', function () {
        return view('docs.movies');
    });
    
    Route::get('/tv-series', function () {
        return view('docs.tv-series');
    });
    
    Route::get('/seasons', function () {
        return view('docs.seasons');
    });
    
    Route::get('/episodes', function () {
        return view('docs.episodes');
    });
});
