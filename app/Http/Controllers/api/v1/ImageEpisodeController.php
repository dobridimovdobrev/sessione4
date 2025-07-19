<?php
namespace App\Http\Controllers\api\v1;

use App\Models\Episode;
use Illuminate\Http\Request;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\Controller;
use App\Http\Resources\api\v1\ImageFileCollection;

class ImageEpisodeController extends Controller
{
    public function store(Request $request, $episodeId)
    {
        $episode = Episode::findOrFail($episodeId);

        $request->validate([
            'image_file_ids' => 'required|array',
            'image_file_ids.*' => 'exists:image_files, image_id'    
        ]);

        $episode->imageFiles()->syncWithoutDetaching($request->image_file_ids);

        return ResponseMessages::success(['message' => 'Images associated successfully.'],200);
    }

    public function destroy($episodeId, $imageId)
    {
        $episode = Episode::findOrFail($episodeId);
        $episode->imageFiles()->detach($imageId);

        return ResponseMessages::success(['message' => 'Image detached successfully.'], 200);
    }

    public function index($episodeId)
    {
        $episode = Episode::findOrFail($episodeId);
        $images = $episode->imageFiles()->get();

        return new ImageFileCollection($images);
    }
}
