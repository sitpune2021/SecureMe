<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'user_role' => 'required',
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|unique:users,email',
            'password'  => 'required|string|min:8|confirmed',
            'phone_no'  => 'required',

        ]);

        $user = User::create([
            'user_role'=> $request->user_role,
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'phone_no' => $request->phone_no,
        ]);

        $token = $user->createToken('secureme_token')->plainTextToken;

        return response()->json([
            'status'  => true,
            'message' => 'User registered successfully',
            'token'   => $token,
            'user'    => $user,
        ], 201);
    }

    // ✅ Login API
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Delete old tokens for better security
        $user->tokens()->delete();

        $token = $user->createToken('secureme_token')->plainTextToken;

        return response()->json([
            'status'  => true,
            'message' => 'Login successful',
            'token'   => $token,
            'user'    => $user,
        ]);
    }

    // ✅ Logout API
    public function logout(Request $request)
    {
        $user = $request->user(); // get authenticated user

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }

        // Safely delete the current access token
        $token = $user->currentAccessToken();
        if ($token) {
            $token->delete();
        }

        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully'
        ]);
    }


    // ✅ Profile API
    public function profile(Request $request)
    {
        return response()->json([
            'status' => true,
            'user'   => $request->user(),
        ]);
    }
}
