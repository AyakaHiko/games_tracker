<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Games\CacheGameController;
use App\Http\Controllers\Games\GamesController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('getUser', 'getUser');
});
Route::resource('games', GamesController::class)->only([
    'index', 'show'
]);
Route::prefix('/update')->group(function () {
    // Путь для обновления списка игр
    Route::get('/games', [CacheGameController::class, 'UpdateGames']);
//    Route::get('/developers', [CacheGameController::class, 'UpdateDevelopers']);

    // Путь для обновления списка жанров
    Route::get('/genres', [CacheGameController::class, 'UpdateGenres']);

    // Путь для обновления деталей игры по ID
    Route::get('/game/{id}', [CacheGameController::class, 'UpdateGameDetails']);
});
