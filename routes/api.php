<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
    });
});
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('content_manager', [\App\Http\Controllers\ContactManagerController::class, 'content_manager']);
    Route::get('content_manager', [\App\Http\Controllers\ContactManagerController::class, 'content_manager']);
});

Route::get('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);

    return ['token' => $token->plainTextToken];
});
// this routes handle non define url address
Route::get('{undefine_address?}/{undefine_address2?}', [\App\Http\Controllers\ContactManagerController::class, 'undefine_address']);
Route::post('{undefine_address?}/{undefine_address2?}', [\App\Http\Controllers\ContactManagerController::class, 'undefine_address']);
