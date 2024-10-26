<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\LikeController;
use App\Http\Controllers\api\v1\UserController;
use App\Http\Controllers\api\v1\ViewController;
use App\Http\Controllers\api\v1\MovieController;
use App\Http\Controllers\api\v1\CreditController;
use App\Http\Controllers\api\v1\MyListController;
use App\Http\Controllers\api\v1\PersonController;
use App\Http\Controllers\api\v1\SeasonController;
use App\Http\Controllers\api\v1\CountryController;
use App\Http\Controllers\api\v1\EpisodeController;
use App\Http\Controllers\api\v1\HistoryController;
use App\Http\Controllers\api\v1\TrailerController;
use App\Http\Controllers\api\v1\TvSerieController;
use App\Http\Controllers\api\v1\CategoryController;
use App\Http\Controllers\api\v1\ImageFileController;
use App\Http\Controllers\api\v1\VideoFileController;
use App\Http\Controllers\api\v1\ImageMovieController;
use App\Http\Controllers\api\v1\VideoMovieController;
use App\Http\Controllers\api\v1\PersonMovieController;
use App\Http\Controllers\api\v1\NotificationController;
use App\Http\Controllers\api\v1\TrailerMovieController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Route::get('/movies', [TMDBService::class, 'getMovies']);
Route::get('/youtube', [YOUTUBEService::class, 'youtubeChannel']); */

//Guests can access only register and login api
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:15,15'); //Login attempts, max 3 time, 15 minutes expiration

//Routes for Version 1 
Route::prefix('v1')->group(function () {
    // Routes  ONLY BY USER ROLE
    Route::middleware(['auth:sanctum', 'role:user'])->group(function () {
        Route::put('/update-profile', [UserController::class, 'updateOwnProfile']);
        Route::post('/add-credits', [UserController::class, 'addCredits']);
    });


    // Routes  ONLY BY ADMIN ROLE
    Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
        //Users
        Route::get('/users', [UserController::class, 'index']);
        Route::put('/users/{id}', [UserController::class, 'update']);
        Route::post('/users', [UserController::class, 'store']);
        Route::delete('/users/{id}', [UserController::class, 'destroy']);
        // Countries
        Route::post('/countries', [CountryController::class, 'store']);
        Route::put('/countries/{country}', [CountryController::class, 'update']);
        Route::delete('/countries/{country}', [CountryController::class, 'destroy']);
        //Categories 
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::put('/categories/{category}', [CategoryController::class, 'update']);
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
        //Persons/Actors
        Route::post('/persons', [PersonController::class, 'store']);
        Route::put('/persons/{person}', [PersonController::class, 'update']);
        Route::delete('/persons/{person}', [PersonController::class, 'destroy']);

        //Person-Movie Pivot
        Route::post('/movies/{movie}/persons', [PersonMovieController::class, 'store']); // Attach persons to movie
        Route::delete('/movies/{movie}/persons/{person}', [PersonMovieController::class, 'destroy']); // Detach a person 
        //Image-Movie Pivot
        Route::post('/movies/{movie}/images', [ImageMovieController::class, 'store']); // Attach images to a movie
        Route::delete('/movies/{movie}/images/{image}', [ImageMovieController::class, 'destroy']); // Detach image from a movie 
        //Video-Movie Pivot
        Route::post('/movies/{movie}/videos', [VideoMovieController::class, 'store']); // Attach videos to a movie
        Route::delete('/movies/{movie}/videos/{video}', [VideoMovieController::class, 'destroy']); // Detach video from a movie 
        //Trailer-Movie Pivot
        Route::post('/movies/{movie}/trailers', [TrailerMovieController::class, 'store']); // Attach trailers to a movie
        Route::delete('/movies/{movie}/trailers/{trailer}', [TrailerMovieController::class, 'destroy']); // Detach trailer from a movie

        // Movies 
        Route::post('/movies', [MovieController::class, 'store']);
        Route::put('/movies/{movie}', [MovieController::class, 'update']);
        Route::delete('/movies/{movie}', [MovieController::class, 'destroy']);
        //Tv Series
        Route::post('/tvseries', [TvSerieController::class, 'store']);
        Route::put('/tvseries/{tvSerie}', [TvSerieController::class, 'update']);
        Route::delete('/tvseries/{tvSerie}', [TvSerieController::class, 'destroy']);
        //Seasons
        Route::post('/seasons', [SeasonController::class, 'store']);
        Route::put('/seasons/{season}', [SeasonController::class, 'update']);
        Route::delete('/seasons/{season}', [SeasonController::class, 'destroy']);
        //Episodes
        Route::post('/episodes', [EpisodeController::class, 'store']);
        Route::put('/episodes/{episode}', [EpisodeController::class, 'update']);
        Route::delete('/episodes/{episode}', [EpisodeController::class, 'destroy']);
        //Credits
        Route::post('/credits/{credit}', [CreditController::class, 'store']);
        Route::delete('/credits/{credit}', [CreditController::class, 'destroy']);
        //Trailers
        Route::post('/trailers', [TrailerController::class, 'store']);
        Route::put('/trailers/{trailer}', [TrailerController::class, 'update']);
        Route::delete('/trailers/{trailer}', [TrailerController::class, 'destroy']);
        //Video Files
        Route::post('/videos', [VideoFileController::class, 'store']);
        Route::put('/videos/{video}', [VideoFileController::class, 'update']);
        Route::delete('/videos/{video}', [VideoFileController::class, 'destroy']);
        //Image Files
        Route::post('/images', [ImageFileController::class, 'store']);
        Route::put('/images/{image}', [ImageFileController::class, 'update']);
        Route::delete('/images/{image}', [ImageFileController::class, 'destroy']);
        //Notifications
        Route::get('/notifications', [NotificationController::class, 'index']);
        Route::post('/notifications', [NotificationController::class, 'store']);
        Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy']);
        //Histories
        Route::get('/histories', [HistoryController::class, 'index']);
        //My List
        Route::get('/mylist', [MyListController::class, 'index']);
        Route::post('/mylist', [MyListController::class, 'store']);
        Route::delete('/mylist/{myList}', [MyListController::class, 'destroy']);
        //Views
        Route::get('/views', [ViewController::class, 'index']);
        //Likes
        Route::get('/likes', [LikeController::class, 'index']);
    });


    // Routes FOR ADMIN AND USER ROLES
    Route::middleware(['auth:sanctum', 'role:admin,user'])->group(function () {
        //User profile owner
        Route::get('/users/{id}', [UserController::class, 'show']);
        //Countries
        Route::get('/countries', [CountryController::class, 'index']);
        Route::get('/countries/{country}', [CountryController::class, 'show']);
        //Categories
        Route::get('/categories', [CategoryController::class, 'index']);
        Route::get('/categories/{category}', [CategoryController::class, 'show']);
        //Persons/Actors
        Route::get('/persons', [PersonController::class, 'index']);
        Route::get('/persons/{person}', [PersonController::class, 'show']);

        //Person-Movie Pivot
        Route::get('/persons/{person}/movies', [PersonMovieController::class, 'show']); // Get all movies for a person
        //Image-Movie Pivot
        Route::get('images/{image}/movies', [ImageMovieController::class, 'show']); // Show all movies for an image
        //Video-Movie Pivot
        Route::get('videos/{video}/movies', [VideoMovieController::class, 'show']); // Show all movies for a video
        //Trailer-Movie Pivot
        Route::get('trailers/{trailer}/movies', [TrailerMovieController::class, 'show']); // Show all movies for a trailer

        //Movies
        Route::get('/movies', [MovieController::class, 'index']);
        Route::get('/movies/{movie}', [MovieController::class, 'show']);
        //Tv Series
        Route::get('/tvseries', [TvSerieController::class, 'index']);
        Route::get('/tvseries/{tvSerie}', [TvSerieController::class, 'show']);
        //Seasons
        Route::get('/seasons', [SeasonController::class, 'index']);
        Route::get('/seasons/{season}', [SeasonController::class, 'show']);
        //Episodes
        Route::get('/episodes', [EpisodeController::class, 'index']);
        Route::get('/episodes/{episode}', [EpisodeController::class, 'show']);
        //Credits
        Route::get('/credits/{credit}', [CreditController::class, 'show']);
        //Trailers
        Route::get('/trailers', [TrailerController::class, 'index']);
        Route::get('/trailers/{trailer}', [TrailerController::class, 'show']);
        //Video Files
        Route::get('/videos', [VideoFileController::class, 'index']);
        Route::get('/videos/{video}', [VideoFileController::class, 'show']);
        //Image Files
        Route::get('/images', [ImageFileController::class, 'index']);
        Route::get('/images/{image}', [ImageFileController::class, 'show']);
        //Notifications
        Route::get('/notifications/{notification}', [NotificationController::class, 'show']);
        //Histories
        Route::get('/histories/{history}', [HistoryController::class, 'show']);
        Route::post('/histories', [HistoryController::class, 'store']);
        Route::put('/histories/{history}', [HistoryController::class, 'update']);
        Route::delete('/histories/{history}', [HistoryController::class, 'destroy']);
        //My List
        Route::get('/mylist/{myList}', [MyListController::class, 'show']);
        //Views
        Route::post('/views', [ViewController::class, 'store']);
        Route::delete('/views/{view}', [ViewController::class, 'destroy']);
        //Likes
        Route::post('/likes', [LikeController::class, 'store']);
        Route::delete('/likes/{like}', [LikeController::class, 'destroy']);
    });
});
