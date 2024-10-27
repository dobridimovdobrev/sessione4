<?php
namespace App\Http\Controllers\api\v1;

use App\Models\TvSerie;
use App\Models\ImageFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageTvSeriesController extends Controller
{
    public function store(Request $request, $tvSeriesId)
    {
        $tvSeries = TvSerie::findOrFail($tvSeriesId);

        $request->validate([
            'images' => 'required|array',
            'images.*.url' => 'required|url',
            'images.*.format' => 'nullable|string',
            'images.*.size' => 'nullable|integer'
        ]);

        foreach ($request->images as $imageData) {
            $image = ImageFile::create($imageData);
            $tvSeries->images()->attach($image->image_id);
        }

        return response()->json(['message' => 'Images attached successfully.'], 200);
    }

    public function destroy($tvSeriesId, $imageId)
    {
        $tvSeries = TvSerie::findOrFail($tvSeriesId);
        $tvSeries->images()->detach($imageId);

        return response()->json(['message' => 'Image detached successfully.'], 200);
    }

    public function index($tvSeriesId)
    {
        $tvSeries = TvSerie::findOrFail($tvSeriesId);
        $images = $tvSeries->images()->get();

        return response()->json($images, 200);
    }
}
