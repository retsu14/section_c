<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'min:6'],
            ]);

            info('test1');

            if (! Auth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Invalid credentials',
                ]);
            }
            info('test2');

            $user = Auth::user();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'User Logged In Succesfully',
                'token' => $token,
            ])->cookie(
                'token',
                $token,
                60 * 24,
                '/',
                "localhost",
                false,
                false,
                false,
                'None'
            );
        } catch (\Throwable $th) {
            report($th);
        }
    }

    public function register(Request $request)
    {
        try {

            $validated = $request->validate([
                'name' => ['required', 'string', 'max:30'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'string', 'max:30'],
            ]);

            $validated['password'] = Hash::make($validated['password']);

            User::create($validated);

            return response()->json([
                'message' => 'User Created Successfully',
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    public function logout()
    {
        try {
            $request->user()?->currentAccessToken()?->delete();

            return response()
                ->json(['message' => 'Logged out'])
                ->cookie('token', '', -1);
        } catch (\Throwable $th) {
            report($th);
        }
    }
}
