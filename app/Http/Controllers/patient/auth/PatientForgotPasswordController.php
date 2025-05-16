<?php

namespace App\Http\Controllers\patient\auth;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

use function Laravel\Prompts\password;

class PatientForgotPasswordController extends Controller
{
    public function sendResetLink(Request $request)
    {
        // need server 
        $request->validate([
            'email' => 'required|email'
        ]);
        $status = Password::broker('patients')->sendResetLink(['email' => $request->email]);
        return response()->json([
            'message' => $status,
            // 'message' => __($status),
        ], $status === Password::RESET_LINK_SENT ? 200 : 400);
    }
    public function resetPasswordForm($token)
    {
        // dd($token);
        return view('resetPasswordForm', compact("token"));
    }

    /**
     * Summary of resetPassword
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    // public function resetPassword(Request $request)
    // {

    //     $data = $request->validate([
    //         'token' => 'required',
    //         'email' => 'required|email',
    //         'password' => 'required|confirmed|min:8',
    //     ]);
    //     $email = $data['email'];
    //     $token = $data['token'];
    //     $record = DB::table('password_reset_tokens')
    //         ->where('email', $email)
    //         ->first();
    //     // dd($record);

    //     if (!$record || !Hash::check($token, $record->token)) {
    //         return response()->json(["message" => "invalid or expier token"], 400);
    //     }
    //     $tokenDeleted = DB::table('password_reset_tokens')->where('email', $email)->delete();
    //     $passwordUpdated = DB::table('patients')
    //         ->where("email", $email)
    //         ->update(['password' => bcrypt($data['password'])]);
    //     if ($passwordUpdated) {
    //         return response()->json([
    //             "message" => "password has been updated",
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             "message" => "somthing gose wrong"
    //         ], 500);
    //     }
    // }
    public function resetPassword(Request $request)
    {
        $data = $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);
        $status = Password::broker("patients")->reset(
            [
                'email' => $request['email'],
                'password' => $request['password'],
                'token' => $request['token'],
                'password_confirmation' => $request['password_confirmation'],
            ],
            function (Patient $patient, $password) {
                $patient->forceFill(
                    ['password' => Hash::make($password)]
                )->save();
            }
        );
        return $status === Password::PASSWORD_RESET
            ? response()->json(["message" => "Password reset successful"], 200)
            : response()->json([__($status)], 400);

    }
}
