<?php

namespace App\Http\Controllers\api\v1;

use App\Models\User;

use App\Models\Session;
use Illuminate\Http\Request;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

        // Revoke all tokens (logout from all devices)
        $profileOwner->tokens()->delete();

        // Clear user sessions (if sessions are stored)
        Session::where('user_id', $profileOwner->user_id)->delete();

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

        //make filtering request using different parameters
        $filterUsers = $request->all();

        //Biuld the query
        $query = User::query();

        //foreach loop with all specified values for making filtering requests
        foreach ($filterUsers as $key => $value) {
            if (in_array($key, ['user_id', 'username', 'email', 'first_name', 'last_name', 'birthday', 'gender', 'user_status'])) {
                $query = $query->where($key, $value);
            }
        }

        //this is for execute the query
        $users = $query->get();

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

        return new UserResource($user);
    }

    /**
     * Update a specified user's profile (for admin use).
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        $validatedData = $request->validated();

        // Retrieve the user by user_id or username
        $user = User::where('user_id', $id)->orWhere('username', $id)->findOrFail();

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
