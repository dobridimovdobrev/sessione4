<?php

namespace App\Http\Controllers\api\v1;
use App\Http\Controllers\Controller;
use App\Models\User;

use App\Models\Session;

use App\Helpers\ResponseMessages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\api\v1\LoginRequest;
use App\Http\Requests\api\v1\RegisterRequest;

class AuthController extends Controller
{
    //Register
    public function register(RegisterRequest $request)
    {
        $userData = $request->validated();

        //hash the password salt is included by default
        $hashedPassword =  $hashedPassword = Hash::make($userData['password']); 

             User::create([
            'username' => $userData['username'],
            'email' => $userData['email'],
            'first_name' => $userData['first_name'],
            'last_name' => $userData['last_name'],
            'gender' => $userData['gender'],
            'birthday' => $userData['birthday'],
            'country_id' => $userData['country_id'],
            'password' => $hashedPassword,
            'role_id' => 2, // User role by default
        ]);

        return ResponseMessages::success('User registered successfully', 201);
    }

    // Login and receive token

    public function login(LoginRequest $request)
{
    $credentials = $request->validated();

    // Check for credentials
    if (!Auth::attempt($credentials)) {
        return ResponseMessages::error('Invalid credentials', 401);
    }

    // Authenticated user
    $user = Auth::user();

    // Define abilities for different roles
    $abilities = [];
    if ($user->role->role_name === 'admin') {
        $abilities = ['*']; // Full access
    } elseif ($user->role->role_name === 'user') {
        $abilities = ['read', 'update-profile', 'add-credits']; // Read most data and update and add credits to their own profile
    }

    // Create token with  abilities
    $token = $user->createToken('auth_token', $abilities)->plainTextToken;

    // Store session information
    Session::create([
        'user_id' => $user->user_id,
        'ip_address' => $request->ip(), // Correct 'ip_adress' to 'ip_address'
        'last_activity' => now()
    ]);

    return ResponseMessages::success(['token' => $token], 201);
} 

  
}