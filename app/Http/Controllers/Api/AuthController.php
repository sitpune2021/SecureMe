<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_role' => 'required|string',
            'name'      => 'required|string|max:255',
            'email'     => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users,email'],
            'password'  => 'required|string|min:8',
            'phone_no'  => ['required', 'string', 'min:10', 'unique:users,phone_no'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation Error',
                'errors'  => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();
        DB::beginTransaction();

        try {
            $user = User::create([
                'user_role' => $validated['user_role'],
                'name'      => $validated['name'],
                'email'     => strtolower($validated['email']),
                'password'  => Hash::make($validated['password']),
                'phone_no'  => $validated['phone_no'],
            ]);

            $token = $user->createToken('auth_api_token')->plainTextToken;
            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Account created successfully',
                'data'    => [
                    'token' => $token,
                    'user'  => $user->only(['id', 'name', 'email', 'phone_no', 'user_role']),
                ],
            ], 201);
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::critical("User Registration Failure", [
                'email' => $request->email,
                'error' => $e->getMessage()
            ]);
            return response()->json([
                'status'  => false,
                'message' => 'Registration failed due to a system error.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'    => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation Error',
                'errors'  => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();
        $user = User::where('email', strtolower(trim($validated['email'])))->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid email or password.',
            ], 401);
        }

        try {
            $user->tokens()->delete();
            $token = $user->createToken('auth_api_token')->plainTextToken;

            return response()->json([
                'status'  => true,
                'message' => 'Login successful',
                'data'    => [
                    'token' => $token,
                    'user'  => $user->only(['id', 'name', 'email', 'user_role', 'phone_no']),
                ],
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status'  => false,
                'message' => 'An error occurred during the login process.',
            ], 500);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        dd($request->all());
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Unauthenticated.',
                ], 401);
            }

            $currentToken = $user->currentAccessToken();

            if ($currentToken) {
                $currentToken->delete();
            }

            return response()->json([
                'status'  => true,
                'message' => 'Logged out successfully.',
            ], 200);
        } catch (\Throwable $e) {
            Log::error("Logout Error: " . $e->getMessage());

            return response()->json([
                'status'  => false,
                'message' => 'Server Error',
                'debug_error' => $e->getMessage()
            ], 500);
        }
    }

    // public function profile(Request $request)
    // {
    //     try {
    //         return response()->json([
    //             'status' => true,
    //             'user'   => $request->user(),
    //         ]);
    //     } catch (\Throwable $e) {
    //         Log::error("Logout Error: " . $e->getMessage());
    //         return response()->json([
    //             'status'  => false,
    //             'message' => 'An error occurred during the logout process.',
    //         ], 500);
    //     }
    // }

    // public function profile(Request $request): JsonResponse
    // {
    //     try {
    //         $user = $request->user();

    //         if (!$user) {
    //             return response()->json([
    //                 'status'  => false,
    //                 'message' => 'User not found or unauthenticated.',
    //             ], 401);
    //         }

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Profile retrieved successfully',
    //             'data'   => [
    //                 'user' => $user->only(['id', 'name', 'email', 'user_role', 'phone_no', 'created_at']),
    //             ],
    //         ], 200);
    //     } catch (\Throwable $e) {
    //         Log::error("Profile Fetch Error: " . $e->getMessage());

    //         return response()->json([
    //             'status'  => false,
    //             'message' => 'An error occurred while fetching the profile.',
    //         ], 500);
    //     }
    // }

    public function profile(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'status'  => false,
                    'message' => 'User not found or unauthenticated.',
                ], 401);
            }

            return response()->json([
                'status' => true,
                'message' => 'Profile retrieved successfully',
                'data'   => [
                    'user' => $user->only(['id', 'name', 'email', 'user_role', 'phone_no', 'created_at']),
                ],
            ], 200);
        } catch (\Throwable $e) {
            // Log::error("Profile Fetch Error: " . $e->getMessage());

            return response()->json([
                'status'  => false,
                'message' => 'An error occurred while fetching the profile.',
            ], 500);
        }
    }
}
