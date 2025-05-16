<?php

use App\Http\Controllers\patient\auth\PatientForgotPasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return __("passwords.throttled");

});


Route::group(
    ['prefix' => 'patient'],
    // uri : patient
    function () {
        Route::group(
            ['prefix' => "auth"],
            // uri : patient/auth
            function () {
                Route::group(
                    ['prefix' => "forgot-password"],
                    // uri : patient/auth/forgot-password
                    function () {
                        Route::get(
                            '/reset-password/{token}',
                            [PatientForgotPasswordController::class, 'resetPasswordForm']
                        )->name('patient.auth.forgot-password.reset-form');

                        Route::post(
                            '/reset',
                            [PatientForgotPasswordController::class, 'resetPassword']
                        )->name('patient.auth.forgot-password.reset');
                    },
                );
            },
        );
    }
);