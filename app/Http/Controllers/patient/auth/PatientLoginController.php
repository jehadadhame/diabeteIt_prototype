<?php

namespace App\Http\Controllers\patient\auth;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientLoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);
        if (!Auth::guard(Patient::GUARD_NAME)->attempt($credentials)) {
            return response()->json(["message" => "incorrect credentials"], 401);
        }
        // return response()->json($credentials);

        /** @var \App\Models\Administrator $user */
        $user = Auth::guard(Patient::GUARD_NAME)->user();

        $token = $user->createToken("api-token")->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
