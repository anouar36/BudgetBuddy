<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DepenseController;
use App\Http\Controllers\TageController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
});


// Depense
Route::post  ('/expenses', [DepenseController::class, 'create']);
Route::get   ('/expenses', [DepenseController::class, 'store']);
Route::get   ('/expenses/{id}', [DepenseController::class, 'show']);
Route::put   ('/expenses/{id}', [DepenseController::class, 'update']);
Route::delete('/expenses/{id}', [DepenseController::class, 'destroy']);

// Tages
Route::post  ('/tages', [TageController::class, 'create']);
Route::get   ('/tages', [TageController::class, 'store']);
Route::get   ('/tages/{id}', [TageController::class, 'show']);
Route::put   ('/tages/{id}', [TageController::class, 'update']);
Route::delete('/tages/{id}', [TageController::class, 'destroy']);









