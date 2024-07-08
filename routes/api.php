<?php

use App\Http\Controllers\UserSettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('login', function () {
    auth()->loginUsingId(\App\Models\User::first()->id);
    return 'you are now logged in !';
})->name('login');

Route::middleware('auth')
    ->name('user.setting.')
    ->controller(UserSettingController::class)
    ->group(
        function () {
            Route::post('settings', 'generateVerificationSetting')
                ->name('generate-verification');
            Route::patch('settings', 'verifyCode')
                ->name('update');
            Route::get('test', 'generateVerificationSetting');
        }
    );
