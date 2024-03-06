<?php

namespace App\Http\Controllers\apis;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Throwable;

class AuthController extends Controller
{
    // Login
    public function login(Request $request)
    {

        try {
            $request->validate(([
                'email' => 'required|email'
            ]));


            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'message' => 'User not found'
                ], 401);
            }

            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'Wrong password'
                ], 401);
            }

            // Generate token
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'message' => 'Login success',
                'access_token' => $token,
                'data' => $user
            ], 200);
        } catch (Throwable $exception) {
            return response()->json([
                'message' => 'error'
            ]);
        }
    }
}
