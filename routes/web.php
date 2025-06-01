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
    try {
        Artisan::call('migrate:fresh --force');
        Artisan::call('db:seed --force');
        return response()->json([
            'status' => 'success',
            'migrate_output' => Artisan::output()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});


Route::get('/deploy-artisan', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        Artisan::call('db:seed', ['--force' => true]);

        return response()->json([
            'status' => 'success',
            'output' => Artisan::output(),
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => explode("\n", $e->getTraceAsString())
        ], 500);
    }
});


Route::get('/clear-cache', function () {
    if (request('key') !== env('MIGRATION_KEY')) {
        abort(403, 'Unauthorized');
    }

    Artisan::call('optimize:clear'); // Clears all caches: config, route, view, etc.

    return 'All Laravel caches cleared.';
});