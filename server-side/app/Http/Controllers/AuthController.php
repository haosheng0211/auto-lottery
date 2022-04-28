<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'logout']]);
    }

    public function login(LoginRequest $request)
    {
        $token = Auth::attempt($request->only(['username', 'password']));

        if (! $token) {
            return response()->json([
                'message' => __('Username or password is incorrect.'),
            ], 400);
        }

        return response()->json([
            'token' => $token,
        ]);
    }

    public function status()
    {
        $user = Auth::user();

        return response()->json([
            'user' => [
                'username' => $user->username,
            ],
        ]);
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }

        return response()->json([
            'message' => __('You have been logged out.'),
        ]);
    }
}
