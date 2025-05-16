<?php

namespace App\Http\Controllers\health_care_provider;

use App\Http\Controllers\Controller;
use App\Models\HealthCareProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HealthCareProviderLogoutController extends Controller
{
    public function logout(Request $request)//: JsonResponse
    {
        $user = Auth::guard(HealthCareProvider::API_GUARD_NAME)->user();
        if ($user && $request->user()->currentAccessToken()) {
            $request->user()->currentAccessToken()->delete();
        }
        return response()->json([
            "message" => "Logged out successfully",
        ]);
    }
}
