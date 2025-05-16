<?php

namespace App\Http\Controllers\health_care_provider;

use App\Http\Controllers\Controller;
use App\Models\HealthCareProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HealthCareProviderHomePageController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::guard(HealthCareProvider::API_GUARD_NAME)->user();
        return response()->json([
            "message" => "welcom home page",
            "user_from_Auth" => $user,
        ]);
    }
}


