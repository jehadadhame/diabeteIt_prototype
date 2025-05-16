<?php

use App\Http\Controllers\health_care_provider\auth\HealthCareProviderLoginController;
use App\Http\Controllers\health_care_provider\HealthCareProviderHomePageController;
use App\Http\Controllers\health_care_provider\HealthCareProviderLogoutController;
use App\Http\Controllers\patient\auth\PatientForgotPasswordController;
use App\Http\Controllers\patient\auth\PatientLoginController;
use App\Http\Controllers\patient\auth\PatientLogoutController;
use App\Models\HealthCareProvider;
use App\Models\Patient;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::post('login', [PatientControllerApi::class, 'login']);

// Route::middleware("auth:sanctum")->get('index', [PatientControllerApi::class, 'index']);
// Route::middleware("auth:patient-api")->get('index', [PatientControllerApi::class, 'index']);

// Route::get('/test', function () {
//     return response()->json(['message' => 'API works!']);
// });


Route::group(
    ['prefix' => 'patient'],
    // uri : api/patient
    function () {
        Route::group(
            ['prefix' => "auth"],
            // uri : api/patient/auth
            // todo : make logout method
            function () {

                Route::post('/login', [PatientLoginController::class, 'login'])->name('api.patient.auth.login');
                Route::middleware('auth:' . Patient::API_GUARD_NAME)
                    ->post('logout', [PatientLogoutController::class, 'logout'])
                    ->name("api.health-care-provider.auth.logout");

                Route::group(
                    ['prefix' => "forgot-password"],
                    // uri : api/patient/auth/forgot-password
                    function () {
                        Route::post('/send-reset-link', [PatientForgotPasswordController::class, 'sendResetLink'])->name('api.patient.auth.forgot-password.send-reset-link');
                    },
                );
            },
        );
    }
);

Route::group(
    ['prefix' => "health-care-provider"],
    // uri : api/health-care-provider
    function () {
        Route::middleware('auth:' . HealthCareProvider::API_GUARD_NAME)
            ->get('index', [HealthCareProviderHomePageController::class, 'index']);

        Route::group(
            ['prefix' => 'auth'],
            // uri : api/health-care-provider/auth
            function () {
                Route::post('login', [HealthCareProviderLoginController::class, 'login'])
                    ->name("api.health-care-provider.auth.login");

                Route::middleware('auth:' . HealthCareProvider::API_GUARD_NAME)
                    ->post('logout', [HealthCareProviderLogoutController::class, 'logout'])
                    ->name("api.health-care-provider.auth.logout");
            }
        );
    }
);