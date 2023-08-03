<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AdController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ImageController;

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

# ads
Route::get('getAllAds', [AdController::class, 'getAllAds']);
Route::get('getAllAdsWithoutStatus', [AdController::class, 'getAllAdsWithoutStatus']);
Route::get('getMapFromId', [AdController::class, 'getMapFromId']);
Route::get('getRents', [AdController::class, 'getRents']);
Route::get('getAdFromId', [AdController::class, 'getAdFromId']);
Route::get('getAdCategories', [AdController::class, 'getAdCategories']);
Route::get('getPhonesFromId', [AdController::class, 'getPhonesFromId']);
Route::get('getAdsFromCategory', [AdController::class, 'getAdsFromCategory']);
Route::get('getAdsFromPhone', [AdController::class, 'getAdsFromPhone']);
Route::get('getRentsWithLocation', [AdController::class, 'getRentsWithLocation']);
Route::get('getAdsFromVehicles', [AdController::class, 'getAdsFromVehicles']);

Route::post('postAd', [AdController::class, 'postAd']);
Route::put('ads/{id}', [AdController::class, 'update']);


# adPhones
// Route::get('adPhones', [AdController::class, 'adPhones']);


# users
Route::get('users', [UserController::class, 'index']);
Route::post('users', [UserController::class, 'store']);

# images
Route::get('getImagesFromAd', [ImageController::class, 'getImagesFromAd']);