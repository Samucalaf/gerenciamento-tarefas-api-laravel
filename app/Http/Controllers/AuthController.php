<?php

namespace App\Http\Controllers;

use App\Mail\UserCreated;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        try {
            $validate = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'nullable|string'
            ]);

            $user = User::create($validate);
            $token = $user->createToken('api-token')->plainTextToken;

            if ($user){
                $email = new UserCreated(
                    $user
                );
            }

            Mail::to($user->email)->send($email);

            return response()->json([
                'message' => 'User registered successfully!',
                'user' => $user,
                'token' => $token
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function login(Request $request)
    {

        $validate = $request->validate([
            'email' => 'required|email|',
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
