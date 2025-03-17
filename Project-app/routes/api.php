<?php

use App\Http\Controllers\DepencePartageController;
use App\Http\Controllers\GroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
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
    Route::post  ('/expenses', [DepenseController::class, 'store']);
    Route::get   ('/expenses', [DepenseController::class, 'index']);
    Route::get   ('/expenses/{id}', [DepenseController::class, 'show']);
    Route::put   ('/expenses/{id}', [DepenseController::class, 'update']);
    Route::delete('/expenses/{id}', [DepenseController::class, 'destroy']);
    Route::post  ('/expenses/{id}/tages', [DepenseController::class, 'attachTags']);
    


    // Tages
    Route::post  ('/tages', [TageController::class, 'store']);
    Route::get   ('/tages', [TageController::class, 'index']);
    Route::get   ('/tages/{id}', [TageController::class, 'show']);
    Route::put   ('/tages/{id}', [TageController::class, 'update']);
    Route::delete('/tages/{id}', [TageController::class, 'destroy']);


    // Création et Gestion des Groupes de Dépenses
    Route::post  ('/groups', [GroupController::class, 'create']); 
    Route::get   ('/groups/{id}', [GroupController::class, 'show']);
    Route::delete('/groups/{id}', [GroupController::class, 'destroy']);


    // Ajout des Dépenses Partagées
    Route::get   ('/groups/{id}/expenses ', [DepencePartageController::class, 'create']);
    Route::delete('groups/{id}/expenses/{expenseId} ', [DepencePartageController::class, 'destroy']);
















