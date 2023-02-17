<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

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
//新規登録
Route::post('/users/register', [AuthController::class, 'register']);

/** 認証後 */
Route::group(['middleware' => ['auth:api']], function () {
    //ユーザー情報取得
    Route::get('/users', [AuthController::class, 'me']);
    //ホーム用ユーザー情報取得
    Route::get('/home/index', [HomeController::class, 'index']);
    //ログアウト
    Route::post('/users/logout', [AuthController::class, 'logout']);
});
