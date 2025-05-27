<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministratorLoginController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);
        if (!Auth::guard(Administrator::GUARD_NAME)->attempt($credentials)) {
            return response()->json(["message" => "incorrect credentials"], 401);
        }

        /** @var \App\Models\Administrator $user */
        $user = Auth::guard(Administrator::GUARD_NAME)->user();

        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json([
            "access_token" => $token,
            "token_type" => "Bearer",
        ]);
    }
}
