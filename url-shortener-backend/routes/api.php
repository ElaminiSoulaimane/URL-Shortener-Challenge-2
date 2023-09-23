<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;

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

// API Routes



Route::post('/urls', [UrlController::class, 'create']);
Route::get('/urls', [UrlController::class, 'index']);

Route::get('/{shortUrl}', [UrlController::class, 'redirectShortUrl']);








Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
