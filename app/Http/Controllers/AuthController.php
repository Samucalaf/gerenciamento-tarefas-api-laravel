<?php

namespace App\Http\Controllers;

use App\Mail\UserCreated;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;


class AuthController extends Controller
{

    public function register(Request $request)
    {
        try {
            $validate = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()->mixedCase()->symbols()]
            ]);

            $user = User::create(attributes: $validate);
            $token = $user->createToken('api-token')->plainTextToken;

            $email = new UserCreated($user);
            Mail::to($user->email)->send($email);

            return response()->json([
                'message' => 'User registered successfully!',
                'user' => $user,
                'token' => $token
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $validate = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string'
            ]);


            if (Auth::attempt($validate)) {
                $user = User::where('email', $validate['email'])->first();
                $token = $user->createToken('api-token')->plainTextToken;
                return response()->json(['message' => 'Login successful', 'token' => $token]);
            } else {
                return response()->json([
                    'error' => 'Invalid credentials'
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function logout(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        $accessToken = PersonalAccessToken::findToken($token);

        if (!$accessToken) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        $accessToken->delete();
        return response()->json([
            'message' => 'Logout successful!'
        ]);
    }
}
