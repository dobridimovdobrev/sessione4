<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Person;
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
    public function index()
    {
        $this->authorize('viewAny', Person::class);

        $people = Person::paginate(100);
        return new PersonCollection($people);
    }
    //create
    public function store(PersonStoreRequest $request)
    {
        $this->authorize('create', Person::class);

        $validatedData = $request->validated();
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
