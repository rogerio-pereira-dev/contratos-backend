<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    { 
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $deviceName = $request->device;
            $token = Auth::user()->createToken($deviceName)->plainTextToken;
 
            return response()->json(['token' => $token]);
        }

        return response()->json([
                        'message' => 'The provided credentials do not match our records.'
                    ], 404);
    }
}
