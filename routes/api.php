<?php

use App\Http\Controllers\administrator\AdministratorHomePageController;
use App\Http\Controllers\administrator\auth\AdministratorLoginController;
use App\Http\Controllers\administrator\auth\AdministratorLogoutController;
use App\Http\Controllers\administrator\AdministratorFoodController;
use App\Http\Controllers\health_care_provider\auth\HealthCareProviderLoginController;
use App\Http\Controllers\health_care_provider\auth\HealthCareProviderLogoutController;
use App\Http\Controllers\health_care_provider\HealthCareProviderHomePageController;
use App\Http\Controllers\patient\auth\PatientForgotPasswordController;
use App\Http\Controllers\patient\auth\PatientLoginController;
use App\Http\Controllers\patient\auth\PatientLogoutController;
use App\Models\Administrator;
use App\Models\HealthCareProvider;
use App\Models\Patient;
use Illuminate\Support\Facades\Artisan;
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
                    ->name("api.patient.auth.logout");

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

Route::group(
    ['prefix' => "administrator"],
    // uri : api/administrator
    function () {
        Route::middleware('auth:' . Administrator::API_GUARD_NAME)
            ->get('index', [AdministratorHomePageController::class, 'index']);

        Route::group(
            ['prefix' => 'auth'],
            // uri : api/administrator/auth
            function () {
                Route::post('login', [AdministratorLoginController::class, 'login'])
                    ->name("api.administrator.auth.login");

                Route::middleware('auth:' . Administrator::API_GUARD_NAME)
                    ->post('logout', [AdministratorLogoutController::class, 'logout'])
                    ->name("api.administrator.auth.logout");
            }
        );
        // uri : api/administrator/food
        Route::resource("food", AdministratorFoodController::class, [])
            ->except('edit', 'create')
            ->middleware("auth:" . Administrator::API_GUARD_NAME);

    }

);


Route::get('/migrate', function () {
    // if (request('key') !== env('MIGRATION_KEY')) {
    //     abort(403, 'Unauthorized');
    // }
    try {
        Artisan::call('migrate:fresh --force');
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

Route::get('/seed/{class_name}', function ($class_name) {
    try {
        if ($class_name == 'all') {
            Artisan::call('db:seed --force');
        } else {
            Artisan::call("db:seed", [
                "--class" => $class_name,
                "--force" => true
            ]);
        }
        return response()->json([
            'status' => 'success',
            'seed_output' => Artisan::output()
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


Route::get('/clear-all-cache', function () {

    Artisan::call('optimize:clear'); // Clears all caches: config, route, view, etc.

    return 'All Laravel caches cleared.';
});


Route::get('/read-log', function () {
    $logFile = storage_path('logs/laravel.log');

    if (!file_exists($logFile)) {
        return 'Log file does not exist.';
    }

    $lines = collect(file($logFile))->take(-30)->implode('');

    return nl2br(e($lines));
});

Route::get('/test-error', function () {
    throw new \Exception('Test exception works!');
});

Route::get('/env-check', function () {
    return response()->json([
        'app_env' => env('APP_ENV'),
        'app_debug' => env('APP_DEBUG'),
    ]);
});

Route::get('/clear-config', function () {
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    return 'Config cache cleared';
});
Route::get('/clear-route', function () {
    Artisan::call('route:clear');
    Artisan::call('route:cache');
    return 'route cache cleared';
});


Route::get('/get-connection-info', function () {
    return response()->json([
        'url' => env('DB_URL', "defualt_value"),
        'connection' => env('DB_CONNECTION', "defualt_value"),
        'host' => env('DB_HOST', "defualt_value"),
        'port' => env('DB_PORT', "defualt_value"),
        'database' => env('DB_DATABASE', "defualt_value"),
        'username' => env('DB_USERNAME', "defualt_value"),
        'password' => env('DB_PASSWORD', "defualt_value"),
        'unix_socket' => env('DB_SOCKET', "defualt_value"),
        'charset' => env('DB_CHARSET', 'utf8mb4'),
        'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
    ]);
});

Route::get('/run-artisan/command', function ($command) {
    try {
        Artisan::call($command);

        return response()->json([
            'status' => 'success',
            'seed_output' => Artisan::output()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});