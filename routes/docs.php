<?php

use Illuminate\Support\Facades\Route;

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

// Authentication routes
Route::get('/authentication', function () {
    return view('docs.authentication');
});

// User routes
Route::get('/user-management', function () {
    return view('docs.user-management');
});

Route::get('/profile', function () {
    return view('docs.profile');
});

// Media routes
Route::get('/images', function () {
    return view('docs.images');
});

Route::get('/trailers', function () {
    return view('docs.trailers');
});

Route::get('/video-files', function () {
    return view('docs.video-files');
});

// Add more documentation routes here
