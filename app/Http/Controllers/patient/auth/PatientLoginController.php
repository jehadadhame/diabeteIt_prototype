<?php

namespace App\Http\Controllers\patient\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientLoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (!Auth::guard('patient')->attempt($credentials)) {
            return response()->json(["message" => "Invalid credentials"], 401);
        }
        // return response()->json($credentials);

        $user = Auth::guard('patient')->user();
        $token = $user->createToken("api-token")->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);

    }
}
