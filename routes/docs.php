<?php

use Illuminate\Support\Facades\Route;

// Introduction
Route::get('/', function () {
    return view('docs.index');
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

// Content routes
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

Route::get('/persons', function () {
    return view('docs.persons');
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

// Metadata routes
Route::get('/categories', function () {
    return view('docs.categories');
});

Route::get('/countries', function () {
    return view('docs.countries');
});

// Angular Integration Guide
Route::get('/angular-integration', function () {
    return view('docs.angular-integration');
});

// Add more documentation routes here

// TV Series API Update Documentation
Route::get('/tv-series-api-update', function () {
    return view('docs.tv-series-api-update');
});
