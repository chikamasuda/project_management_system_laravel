<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TodoListController;

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

    //顧客管理
    Route::controller(ClientController::class)->group(function () {
        //顧客検索
        Route::get('/clients/search', 'search');
        //csvダウンロード
        Route::get('/clients/download', 'download');
    });

    //案件管理
    Route::controller(ProjectController::class)->group(function () {
        //案件検索
        Route::get('/projects/search', 'search');
        //csvダウンロード
        Route::get('/projects/download', 'download');
    });

    //売上管理
    Route::controller(SaleController::class)->group(function () {
        //売上集計・分析
        Route::get('/sales/analysis', 'analysis');
    });

    //CRUD機能
    Route::apiResources([
        'clients'  => ClientController::class,
        'projects' => ProjectController::class,
        'todo-lists' => TodoListController::class,
    ]);
});
