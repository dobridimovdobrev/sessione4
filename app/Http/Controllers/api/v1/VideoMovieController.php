<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\ResponseMessages;
use App\Models\Movie;
use App\Models\VideoFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoMovieController extends Controller
{
    // Attach videos to a movie
    public function store(Request $request, $movieId)
    {
        $movie = Movie::findOrFail($movieId);

        // Validate video ids
        $request->validate([
            'video_ids' => 'required|array',
            'video_ids.*' => 'exists:video_files,video_file_id'
        ]);

        // Attach videos to the movie
        $movie->videoFiles()->syncWithoutDetaching($request->video_ids);

        return ResponseMessages::success(['message' => 'Videos associated successfully.'], 200);
    }

    // Detach a video from a movie
    public function destroy($movieId, $videoId)
    {
        $movie = Movie::findOrFail($movieId);
        $movie->videoFiles()->detach($videoId);

        return ResponseMessages::success(['message' => 'Video detached successfully.'], 200);
    }

    // Show all videos attached to a movie
    public function index($movieId)
    {
        $movie = Movie::findOrFail($movieId);
        $videos = $movie->videoFiles()->get();

        return ResponseMessages::success($videos, 200);
    }

    // Show all movies for a video
    public function show($videoId)
    {
        $video = VideoFile::findOrFail($videoId);
        $movies = $video->movies()->get();

        return ResponseMessages::success($movies, 200);
    }
}
