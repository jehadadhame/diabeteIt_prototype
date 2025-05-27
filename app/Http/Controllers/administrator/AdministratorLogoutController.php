<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministratorLogoutController extends Controller
{
    public function logout(Request $request)
    {
        $user = Auth::guard(Administrator::API_GUARD_NAME)->user();
        if ($user && $request->user()->currentAccessToken()) {
            $request->user()->currentAccessToken()->delete();
        }
        return response()->json([
            'message' => 'Logged out successfuly'
        ]);
    }
}
