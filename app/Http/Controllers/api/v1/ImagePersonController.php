<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\ImageFile;
use Illuminate\Http\Request;

class ImagePersonController extends Controller
{
    public function store(Request $request, $personId)
    {
        $person = Person::findOrFail($personId);

        $request->validate([
            'images' => 'required|array',
            'images.*.url' => 'required|url',
            'images.*.format' => 'required|string',
            'images.*.size' => 'required|integer',
        ]);

        foreach ($request->images as $imageData) {
            $image = ImageFile::create($imageData);
            $person->images()->attach($image->image_id);
        }

        return response()->json(['message' => 'Images attached to person successfully.'], 200);
    }

    public function destroy($personId, $imageId)
    {
        $person = Person::findOrFail($personId);
        $person->images()->detach($imageId);

        return response()->json(['message' => 'Image detached from person successfully.'], 200);
    }

    public function index($personId)
    {
        $person = Person::findOrFail($personId);
        $images = $person->images()->get();

        return response()->json($images, 200);
    }
}

