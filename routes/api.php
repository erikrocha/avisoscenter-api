<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AdController;

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
#ads
Route::get('ads', [AdController::class, 'index']);

#adPhones
Route::get('adPhones', [AdController::class, 'adPhones']);
Route::get('searchAdCategories', [AdController::class, 'searchAdCategories']);
Route::get('searchAdPhones', [AdController::class, 'searchAdPhones']);
