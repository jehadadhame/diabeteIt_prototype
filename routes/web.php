<?php

use App\Http\Controllers\patient\auth\PatientForgotPasswordController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/run-command', function () {
    // if (request('key') !== env('MIGRATION_KEY')) {
    //     abort(403, 'Unauthorized');
    // }

    Artisan::call('migrate:fresh --force');
    Artisan::call('db:seed --force');

    return 'Migration and seeding complete.';
});