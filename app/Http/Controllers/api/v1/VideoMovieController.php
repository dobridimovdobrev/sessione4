<?php

namespace App\Http\Controllers\api\v1;

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

        return response()->json(['message' => 'Videos associated successfully.'], 200);
    }

    // Detach a video from a movie
    public function destroy($movieId, $videoId)
    {
        $movie = Movie::findOrFail($movieId);
        $movie->videoFiles()->detach($videoId);

        return response()->json(['message' => 'Video detached successfully.'], 200);
    }

    // Show all videos attached to a movie
    public function index($movieId)
    {
        $movie = Movie::findOrFail($movieId);
        $videos = $movie->videoFiles()->get();

        return response()->json($videos, 200);
    }

    // Show all movies for a video
    public function show($videoId)
    {
        $video = VideoFile::findOrFail($videoId);
        $movies = $video->movies()->get();

        return response()->json($movies, 200);
    }
}
