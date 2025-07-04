<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(LoginUserRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'message' => 'Wrong email or password',
            ],401);
        }
        $user = User::query()->where('email', $request->email)->first();
        $user->tokens()->delete();
        return response()->json([
            'user' => $user,
            'token' => $user->createToken('api-token')->plainTextToken,
        ]);
    }
    public function logout(Request $request)
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);

    }
    public function register(StoreUserRequest $request)
    {
        return User::create(request(['name', 'email', 'password']));
    }


}
