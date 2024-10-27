<?php
namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Season;
use App\Models\ImageFile;
use Illuminate\Http\Request;

class ImageSeasonController extends Controller
{
    public function store(Request $request, $seasonId)
    {
        $season = Season::findOrFail($seasonId);

        $request->validate([
            'images' => 'required|array',
            'images.*.url' => 'required|url',
            'images.*.format' => 'required|string',
            'images.*.size' => 'required|integer'
        ]);

        foreach ($request->images as $imageData) {
            $image = ImageFile::create($imageData);
            $season->images()->attach($image->image_id);
        }

        return response()->json(['message' => 'Images attached successfully.'], 200);
    }

    public function destroy($seasonId, $imageId)
    {
        $season = Season::findOrFail($seasonId);
        $season->images()->detach($imageId);

        return response()->json(['message' => 'Image detached successfully.'], 200);
    }

    public function index($seasonId)
    {
        $season = Season::findOrFail($seasonId);
        $images = $season->images()->get();

        return response()->json($images, 200);
    }
}

