<?php

namespace App\Http\Controllers\api\v1;

use App\Models\User;

use Illuminate\Http\Request;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\api\v1\UserResource;
use App\Http\Resources\api\v1\UserCollection;
use App\Http\Requests\api\v1\UserStoreRequest;
use App\Http\Requests\api\v1\UserUpdateRequest;

class UserController extends Controller
{

    /**
     * Update the authenticated user's own profile.
     */
    public function updateOwnProfile(UserUpdateRequest $request)
    {
        //authenticated user
        $profileOwner = Auth::user();

        //policy authorization to perform an action
        $this->authorize('update', $profileOwner);

        //validate data
        $validatedData = $request->validated();

        // Hash the password before saving
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        //update
        $profileOwner->update($validatedData);

        //success message
        return ResponseMessages::success(['message' => 'Profile updated successfully.', 'user' => new UserResource($profileOwner)], 200);
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //policy authorization to perform an action
        $this->authorize('viewAny', User::class);

        //Build the query
        $query = User::query();

        // Handle global search parameter
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('username', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('first_name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('last_name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Handle specific filters
        if ($request->has('status') && !empty($request->status)) {
            $query->where('user_status', $request->status);
        }

        if ($request->has('gender') && !empty($request->gender)) {
            $query->where('gender', $request->gender);
        }

        if ($request->has('role') && !empty($request->role)) {
            $query->where('role_id', $request->role);
        }

        // Handle other exact match filters
        $exactFilters = ['user_id', 'country_id', 'birthday'];
        foreach ($exactFilters as $filter) {
            if ($request->has($filter) && !empty($request->$filter)) {
                $query->where($filter, $request->$filter);
            }
        }

        // Get pagination parameter
        $perPage = $request->get('perPage', 10);
        
        //Execute the query with pagination
        $users = $query->paginate($perPage);

        // User collection 
        return new UserCollection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {   //policy authorization to perform an action
        $this->authorize('create', User::class);

        //validation data
        $validatedData = $request->validated();

        // Hash the password before saving
        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        //create a user
        $user = User::create($validatedData);

        //success message
        return ResponseMessages::success(['message' => 'User created successfully.', 'user' => new UserResource($user)], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        //policy authorization to perform an action
        $this->authorize('view', $user);

        // Get the most recent session for this user to retrieve IP address
        $session = DB::table('sessions')
            ->where('user_id', $user->user_id)
            ->orderBy('last_activity', 'desc')
            ->first();

        // Add IP address and last activity to user object
        $user->ip_address = $session ? $session->ip_address : null;
        $user->last_activity = $session ? $session->last_activity : null;

        return new UserResource($user);
    }

    /**
     * Update a specified user's profile (for admin use).
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        $validatedData = $request->validated();

        // Retrieve the user by user_id or username
        $user = User::where('user_id', $id)->orWhere('username', $id)->firstOrFail();

        // Policy authorization to perform an action
        $this->authorize('update', $user);

        // Check if the password is being updated
        if (!empty($validatedData['password'])) {
            // Hash the password before saving
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        // Update the user with the validated data
        $user->update($validatedData);

        return ResponseMessages::success(['message' => 'User profile updated successfully.', 'user' => new UserResource($user)], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //find the user 
        $user = User::findOrFail($id);

        //policy authorization to perform an action
        $this->authorize('delete', $user);

        //delete the user
        $user->delete();

        //success message
        return ResponseMessages::success('User deleted successfully.', 204);
    }
}
