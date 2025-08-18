<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Person;
use Illuminate\Http\Request;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\Controller;
use App\Http\Resources\api\v1\PersonResource;
use App\Http\Resources\api\v1\PersonCollection;
use App\Http\Requests\api\v1\PersonStoreRequest;
use App\Http\Requests\api\v1\PersonUpdateRequest;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Person::class);

          // Apply filters if any
          $filterData = $request->all();
          $query = Person::query()
            ->with(['imageFiles' => function($query) {
                $query->wherePivot('type', 'persons')->limit(1);
            }]);
      
          // Filter Persons by different parameters/keys
          foreach ($filterData as $key => $value) {
              if (in_array($key, ['person_id', 'name'])) {
                  $query->where($key, 'LIKE', "%$value%");
              }
          }

        $people = $query->paginate(20);
        return new PersonCollection($people);
    }
    //create
    public function store(PersonStoreRequest $request)
    {
        $this->authorize('create', Person::class);

        $validatedData = $request->validated();
        // Check for an existing person with the same name
        $existingPerson = Person::where(['name' => $validatedData['name']])->first();

        if ($existingPerson) {
            // If image_file_id is provided, associate it with existing person
            if (!empty($validatedData['image_file_id'])) {
                $existingPerson->imageFiles()->syncWithoutDetaching([
                    $validatedData['image_file_id'] => ['type' => 'persons']
                ]);
            }
            return ResponseMessages::success(
                ['message' => 'Person already exists', 'person' => new PersonResource($existingPerson->load('imageFiles'))],
                200
            );
        }
        
        //create a person if not exist in the database
        $person = Person::create(['name' => $validatedData['name']]);

        // Associate image if provided
        if (!empty($validatedData['image_file_id'])) {
            $person->imageFiles()->attach($validatedData['image_file_id'], ['type' => 'persons']);
        }

        return ResponseMessages::success(
            ['message' => 'Person created successfully', 'person' => new PersonResource($person->load('imageFiles'))], 
            201
        );
    }
    //show
    public function show(Person $person)
    {
        $this->authorize('view', $person);

        return new PersonResource($person);
    }
    //update
    public function update(PersonUpdateRequest $request, Person $person)
    {
        $this->authorize('update', $person);

        $validatedData = $request->validated();
        
        // Update person name if provided
        if (isset($validatedData['name'])) {
            $person->update(['name' => $validatedData['name']]);
        }

        // Handle image association/replacement only if image_file_id is provided
        if (array_key_exists('image_file_id', $validatedData)) {
            if ($validatedData['image_file_id'] !== null) {
                // Replace existing image with new one
                $person->imageFiles()->wherePivot('type', 'persons')->detach();
                $person->imageFiles()->attach($validatedData['image_file_id'], ['type' => 'persons']);
            } else {
                // Remove image if null is explicitly sent
                $person->imageFiles()->wherePivot('type', 'persons')->detach();
            }
        }
        // If image_file_id is not in request, leave existing image unchanged

        return ResponseMessages::success(
            ['message' => 'Person updated successfully', 'person' => new PersonResource($person->load('imageFiles'))], 
            200
        );
    }
    //delete
    public function destroy(Person $person)
    {
        $this->authorize('delete', $person);

        $person->delete();
        return ResponseMessages::success('Person deleted successfully', 204);
    }
}
