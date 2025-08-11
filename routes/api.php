<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\DashboardController;
use App\Http\Controllers\api\v1\UserController;
use App\Http\Controllers\api\v1\MovieController;
use App\Http\Controllers\api\v1\CreditController;
use App\Http\Controllers\api\v1\PersonController;
use App\Http\Controllers\api\v1\SeasonController;
use App\Http\Controllers\api\v1\CountryController;
use App\Http\Controllers\api\v1\EpisodeController;
use App\Http\Controllers\api\v1\TrailerController;
use App\Http\Controllers\api\v1\TvSerieController;
use App\Http\Controllers\api\v1\CategoryController;
use App\Http\Controllers\api\v1\ImageFileController;
use App\Http\Controllers\api\v1\VideoFileController;
use App\Http\Controllers\api\v1\ImageMovieController;
use App\Http\Controllers\api\v1\VideoMovieController;
use App\Http\Controllers\api\v1\ImagePersonController;
use App\Http\Controllers\api\v1\PersonMovieController;
use App\Http\Controllers\api\v1\ImageEpisodeController;
use App\Http\Controllers\api\v1\TrailerMovieController;
use App\Http\Controllers\api\v1\ImageTvSeriesController;
use App\Http\Controllers\api\v1\PersonTvSeriesController;
use App\Http\Controllers\api\v1\TrailerTvSeriesController;
use App\Http\Controllers\api\v1\VideoFileEpisodeController;
use App\Http\Controllers\api\v1\StreamController;
use App\Http\Controllers\api\v1\FileUploadController;

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

//Guests can access only register and login api and public video streaming
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:15,10'); //Login attempts, max 3 time, 15 minutes expiration
Route::get('/v1/public-video/{filename}', [StreamController::class, 'publicStreamVideo']); // Accesso pubblico ai video

//Routes for Version 1 
Route::prefix('v1')->group(function () {
    // Routes  FOR USER  AND ADMIN ROLE
    Route::middleware(['auth:sanctum', 'role:admin,user'])->group(function () {
        Route::put('/update-profile', [UserController::class, 'updateOwnProfile']);
        Route::post('/credits', [CreditController::class, 'store']);
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

        // Person - TV Series Pivot
        Route::post('/tvseries/{tvSeries}/persons', [PersonTvSeriesController::class, 'store']); // Attach persons to TV series
        Route::delete('/tvseries/{tvSeries}/persons/{person}', [PersonTvSeriesController::class, 'destroy']); // Detach person
        // Image - TV Series Pivot
        Route::post('/tvseries/{tvSeries}/images', [ImageTvSeriesController::class, 'store']); // Attach images to TV series
        Route::delete('/tvseries/{tvSeries}/images/{image}', [ImageTvSeriesController::class, 'destroy']); // Detach image
        // Trailer - TV Series Pivot
        Route::post('/tvseries/{tvSeries}/trailers', [TrailerTvSeriesController::class, 'store']); // Attach trailer to TV series
        Route::delete('/tvseries/{tvSeries}/trailers/{trailer}', [TrailerTvSeriesController::class, 'destroy']); // Detach trailer

        // Image - Episode Pivot
        Route::post('/episodes/{episode}/images', [ImageEpisodeController::class, 'store']); // Attach images to episode
        Route::delete('/episodes/{episode}/images/{image}', [ImageEpisodeController::class, 'destroy']); // Detach image
        // Video - Episode Pivot
        Route::post('/episodes/{episode}/videos', [VideoFileEpisodeController::class, 'store']); // Attach videos to episode
        Route::delete('/episodes/{episode}/videos/{video}', [VideoFileEpisodeController::class, 'destroy']); // Detach video

        //Image-Person Pivot
        Route::post('/persons/{person}/images', [ImagePersonController::class, 'store']); // Attach images to a person
        Route::delete('/persons/{person}/images/{image}', [ImagePersonController::class, 'destroy']); // Detach image from person

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
        Route::get('/credits/{credit}', [CreditController::class, 'show']);
        Route::delete('/credits/{credit}', [CreditController::class, 'destroy']);
        //Trailers
        Route::post('/trailers', [TrailerController::class, 'store']);
        Route::put('/trailers/{trailer}', [TrailerController::class, 'update']);
        Route::delete('/trailers/{trailer}', [TrailerController::class, 'destroy']);
        //Video Files
        Route::post('/videos', [VideoFileController::class, 'store']);
        Route::put('/videos/{videoFile}', [VideoFileController::class, 'update']);
        Route::delete('/videos/{videoFile}', [VideoFileController::class, 'destroy']);
        //Image Files
        Route::post('/images', [ImageFileController::class, 'store']);
        Route::put('/images/{image}', [ImageFileController::class, 'update']);
        Route::delete('/images/{image}', [ImageFileController::class, 'destroy']);
        
        // File Upload Routes (dedicated for Angular frontend)
        Route::post('/upload/image', [FileUploadController::class, 'uploadImage']);
        Route::post('/upload/video', [FileUploadController::class, 'uploadVideo']);
        Route::get('/upload/progress', [FileUploadController::class, 'getUploadProgress']);
        Route::get('/upload/formats', [FileUploadController::class, 'getSupportedFormats']);
        
        //Dashboard Statistics
        Route::get('/dashboard/stats', [DashboardController::class, 'getStats']);
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
        Route::get('/videos', [VideoFileController::class, 'index']);
        Route::get('/videos/{videoFile}', [VideoFileController::class, 'show']);

        //Person-Movie Pivot
        Route::get('/persons/{person}/movies', [PersonMovieController::class, 'index']); // Get all movies for a person
        //Image-Movie Pivot
        Route::get('images/{image}/movies', [ImageMovieController::class, 'show']); // Show all movies for an image
        //Video-Movie Pivot
        Route::get('videos/{video}/movies', [VideoMovieController::class, 'show']); // Show all movies for a video
        //Trailer-Movie Pivot
        Route::get('trailers/{trailer}/movies', [TrailerMovieController::class, 'show']); // Show all movies for a trailer

        //Person-Tv Series Pivot
        Route::get('/tvseries/{tvSeries}/persons', [PersonTvSeriesController::class, 'index']); // Get all persons for TV series
        //Trailer-Tv Series Pivot
        Route::get('/tvseries/{tvSeries}/trailers', [TrailerTvSeriesController::class, 'index']); // Get all trailers for TV series
        //Image-Tv Series Pivot
        Route::get('/tvseries/{tvSeries}/images', [ImageTvSeriesController::class, 'index']); // Get all images for TV series

        //Image-Episode Pivot
        Route::get('/episodes/{episode}/images', [ImageEpisodeController::class, 'index']); // Get all images for episode

        //Image-Person Pivot
        Route::get('/persons/{person}/images', [ImagePersonController::class, 'index']); // Get all images for a person

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
        Route::get('/credits', [CreditController::class, 'index']);
        Route::get('/credits/{credit}', [CreditController::class, 'show']);
        //Trailers
        Route::get('/trailers', [TrailerController::class, 'index']);
        Route::get('/trailers/{trailer}', [TrailerController::class, 'show']);
        //Video Files
        Route::get('/videos', [VideoFileController::class, 'index']);
        Route::get('/videos/{videoFile}', [VideoFileController::class, 'show']);
        //Image Files
        Route::get('/images', [ImageFileController::class, 'index']);
        Route::get('/images/{image}', [ImageFileController::class, 'show']);
        
        // Stream video (protetto da autenticazione)
        Route::get('/stream-video/{filename}', [StreamController::class, 'streamVideo']);
        
    });
});
