<?php
namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\ImageFile;
use Illuminate\Http\Request;

class ImageEpisodeController extends Controller
{
    public function store(Request $request, $episodeId)
    {
        $episode = Episode::findOrFail($episodeId);

        $request->validate([
            'images' => 'required|array',
            'images.*.url' => 'required|url',
            'images.*.format' => 'required|string',
            'images.*.size' => 'required|integer'
        ]);

        foreach ($request->images as $imageData) {
            $image = ImageFile::create($imageData);
            $episode->images()->attach($image->image_id);
        }

        return response()->json(['message' => 'Images attached successfully.'], 200);
    }

    public function destroy($episodeId, $imageId)
    {
        $episode = Episode::findOrFail($episodeId);
        $episode->images()->detach($imageId);

        return response()->json(['message' => 'Image detached successfully.'], 200);
    }

    public function index($episodeId)
    {
        $episode = Episode::findOrFail($episodeId);
        $images = $episode->images()->get();

        return response()->json($images, 200);
    }
}
