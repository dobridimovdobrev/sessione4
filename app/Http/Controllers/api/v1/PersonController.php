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
                $query->where('person_image.type', 'profile')->limit(1);
            }]);
      
          // Filter Persons by different parameters/keys
          foreach ($filterData as $key => $value) {
              if (in_array($key, ['person_id', 'name'])) {
                  $query->where($key, 'LIKE', "%$value%");
              }
          }

        $people = $query->paginate(100);
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
            return ResponseMessages::success(
                ['message' => 'Person already exists', 'person' => new PersonResource($existingPerson)],
                200
            );
        }
        //create a person if not exist in the database
        $person = Person::create($validatedData);

        return ResponseMessages::success(
            ['message' => 'Person created successfully', 'person' => new PersonResource($person)], 
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
        $person->update($validatedData);

        return ResponseMessages::success(
            ['message' => 'Person updated successfully', 'person' => new PersonResource($person)], 
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
