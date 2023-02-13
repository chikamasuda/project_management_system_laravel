<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

/** 認証前 */
//ログイン
Route::post('/users/login', [AuthController::class, 'login']);

/** 認証後 */
Route::group(['middleware' => ['auth:api']], function () {
    //ユーザー情報取得
    Route::get('/users', [AuthController::class, 'me']);
    //ログアウト
    Route::post('/users/logout', [AuthController::class, 'logout']);
});
