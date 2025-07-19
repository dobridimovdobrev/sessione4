<?php
namespace App\Http\Controllers\api\v1;

use App\Models\Season;
use Illuminate\Http\Request;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\Controller;
use App\Http\Resources\api\v1\ImageFileCollection;

class ImageSeasonController extends Controller
{
    public function store(Request $request, $seasonId)
    {
        $season = Season::findOrFail($seasonId);

        $request->validate([
            'image_file_ids' => 'required|array',
            'image_file_ids.*' => 'exists:image_files,image_id'
        ]);

        $season->imageFiles()->syncWithoutDetaching($request->image_file_ids);

        return ResponseMessages::success(['message' => 'Images associated successfully.'],200);
    }

    public function destroy($seasonId, $imageId)
    {
        $season = Season::findOrFail($seasonId);
        $season->imageFiles()->detach($imageId);

        return ResponseMessages::success(['message' => 'Image detached successfully.'], 200);
    }

    public function index($seasonId)
    {
        $season = Season::findOrFail($seasonId);
        $images = $season->imageFiles()->get();

        return new ImageFileCollection($images);
    }
}

