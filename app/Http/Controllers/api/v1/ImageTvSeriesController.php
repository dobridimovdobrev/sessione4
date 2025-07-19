<?php
namespace App\Http\Controllers\api\v1;

use App\Helpers\ResponseMessages;
use App\Models\TvSerie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\api\v1\ImageFileCollection;


class ImageTvSeriesController extends Controller
{
    public function store(Request $request, $tvSeriesId)
    {
        $tvSeries = TvSerie::findOrFail($tvSeriesId);

        $request->validate([
            'image_file_ids' => 'required|array',
            'image_file_ids.*' => 'exists:image_files,image_id'
        ]);

        $tvSeries->imageFiles()->syncWithoutDetaching($request->image_file_ids);

        return ResponseMessages::success(['message' => 'Images associated successfully.'],200);
    }

    public function destroy($tvSeriesId, $imageId)
    {
        $tvSeries = TvSerie::findOrFail($tvSeriesId);
        $tvSeries->imageFiles()->detach($imageId);

        return ResponseMessages::success(['message' => 'Image detached successfully.'], 200);
    }

    public function index($tvSeriesId)
    {
        $tvSeries = TvSerie::findOrFail($tvSeriesId);
        $images = $tvSeries->imageFiles()->get();

        return new ImageFileCollection($images);
    }
}
