<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\ResponseMessages;
use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\VideoFile;
use Illuminate\Http\Request;

class VideoFileEpisodeController extends Controller
{
    public function store(Request $request, $episodeId)
    {
        $episode = Episode::findOrFail($episodeId);

        $request->validate([
            'videos' => 'required|array',
            'videos.*.url' => 'required|url',
            'videos.*.format' => 'required|string',
            'videos.*.size' => 'required|integer'
        ]);

        foreach ($request->videos as $videoData) {
            $video = VideoFile::create($videoData);
            $episode->videos()->attach($video->video_file_id);
        }

        return ResponseMessages::success(['message' => 'Videos attached successfully.'], 200);
    }

    public function destroy($episodeId, $videoId)
    {
        $episode = Episode::findOrFail($episodeId);
        $episode->videos()->detach($videoId);

        return ResponseMessages::success(['message' => 'Video detached successfully.'], 200);
    }

}

