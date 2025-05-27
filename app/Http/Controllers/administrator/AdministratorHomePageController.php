<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministratorHomePageController extends Controller
{
    public function index()
    {
        $user = Auth::guard(Administrator::API_GUARD_NAME)->user();
        return response()->json([
            "message" => "welcom home page",
            "user_from_Auth" => $user,
        ]);
    }
}
