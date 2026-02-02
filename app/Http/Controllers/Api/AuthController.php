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
        // dd($request->all());
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
            dd($e);
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
            'password' => ['required', 'string', 'min:8'],
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
