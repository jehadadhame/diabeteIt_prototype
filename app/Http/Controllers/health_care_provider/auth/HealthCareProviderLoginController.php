<?php

namespace App\Http\Controllers\health_care_provider\auth;

use App\Http\Controllers\Controller;
use App\Models\HealthCareProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HealthCareProviderLoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::guard('health_care_provider')->attempt($credentials)) {
            return response()->json(["message" => "incorrect credentials"], 401);
        }
        /** @var \App\Models\Administrator $user */
        $user = Auth::guard("health_care_provider")->user();
        $token = $user->createToken(name: 'api-token')->plainTextToken;
        return response()->json(
            [
                "access_token" => $token,
                "token_type" => "Bearer",
            ]
        );
    }
}
