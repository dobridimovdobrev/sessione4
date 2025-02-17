<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Person;
use Illuminate\Http\Request;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\Controller;
use App\Http\Resources\api\v1\ImageFileCollection;

class ImagePersonController extends Controller
{
    public function store(Request $request, $personId)
    {
        $person = Person::findOrFail($personId);

        $request->validate([
            'image_file_ids' => 'required|array',
            'image_file_ids.*' => 'exists:image_files, image_id'
        ]);

        $person->images()->syncWithoutDetaching($request->image_file_ids);

        return ResponseMessages::success(['message' => 'Images associated successfully.'],200);
    }

    public function destroy($personId, $imageId)
    {
        $person = Person::findOrFail($personId);
        $person->images()->detach($imageId);

        return ResponseMessages::success(['message' => 'Image detached successfully.'], 200);
    }

    public function index($personId)
    {
        $person = Person::findOrFail($personId);
        $images = $person->images()->get();

        return new ImageFileCollection($images);
    }
}
