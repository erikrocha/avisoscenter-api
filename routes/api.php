<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AdController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\ConfigController;
use App\Http\Controllers\API\BusinessController;
use App\Http\Controllers\API\GastosController;
use App\Http\Controllers\API\CommentController;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::middleware(['auth:sanctum'])->group(function () {

  # ads
  Route::get('getAllAds', [AdController::class, 'getAllAds']);
  Route::get('getAllAdsWithoutStatus', [AdController::class, 'getAllAdsWithoutStatus']);
  Route::get('getMapFromId', [AdController::class, 'getMapFromId']);
  Route::get('getRents', [AdController::class, 'getRents']);
  Route::get('getAdFromId', [AdController::class, 'getAdFromId']);
  Route::get('getAdFromIdV2', [AdController::class, 'getAdFromIdV2']);
  Route::get('getAdCategories', [AdController::class, 'getAdCategories']);
  Route::get('getPhonesFromId', [AdController::class, 'getPhonesFromId']);
  Route::get('getAdsFromCategory', [AdController::class, 'getAdsFromCategory']);
  Route::get('getAdsFromCategoryV2', [AdController::class, 'getAdsFromCategoryV2']);
  Route::get('getAdsFromPhone', [AdController::class, 'getAdsFromPhone']);
  Route::get('getRentsWithLocation', [AdController::class, 'getRentsWithLocation']);
  Route::get('getAdsFromVehicles', [AdController::class, 'getAdsFromVehicles']);
  Route::get('getAdsFromVehiclesV2', [AdController::class, 'getAdsFromVehiclesV2']);
  Route::get('getLastIdAd', [AdController::class, 'getLastIdAd']);

  Route::post('postAd', [AdController::class, 'postAd']);
  Route::put('ads/{id}', [AdController::class, 'update']);

  # brand
  Route::get('getAllBrands', [AdController::class, 'getAllBrands']);
  Route::post('brandPost', [AdController::class, 'brandPost']);
  Route::put('brands/{id}', [AdController::class, 'brandUpdate']);

  # model
  Route::get('getAllModels', [AdController::class, 'getAllModels']);
  Route::get('getModelsByBrandId', [AdController::class, 'getModelsByBrandId']);
  Route::post('modelPost', [AdController::class, 'modelPost']);
  Route::put('models/{id}', [AdController::class, 'modelUpdate']);

  # land
  Route::get('getLandsWithLocation', [AdController::class, 'getLandsWithLocation']);

  # adPhones
  // Route::get('adPhones', [AdController::class, 'adPhones']);

  # users
  Route::get('users', [UserController::class, 'index']);
  Route::post('checkEmailExists', [UserController::class, 'checkEmailExists']);
  //Route::post('users', [UserController::class, 'store']);

  # images
  Route::get('getImagesFromAd', [ImageController::class, 'getImagesFromAd']);

  # popups
  Route::get('get/popups', [AdController::class, 'getPopups']);

  # configs
  Route::get('get/version', [ConfigController::class, 'getVersion']);

  # businesses
  Route::get('getAllBads', [BusinessController::class, 'getAllBads']);
  Route::get('getAllBcategories', [BusinessController::class, 'getAllBcategories']);
  Route::get('getAllBusinesses', [BusinessController::class, 'getAllBusinesses']);
  Route::get('getBusinessById/{id}', [BusinessController::class, 'getBusinessById']);
  Route::get('getBusinessesByBcategory', [BusinessController::class, 'getBusinessesByBcategory']);

  # comments
  Route::resource('comments', CommentController::class);

  /** APP GASTOS */
  # transactions
  Route::get('getTransactions', [GastosController::class, 'getTransactions']);
  Route::get('getTransactionsByDay', [GastosController::class, 'getTransactionsByDay']);
  Route::post('postTransaction', [GastosController::class, 'postTransaction']);
  Route::put('transactions/{id}', [GastosController::class, 'putTransaction']);
  Route::get('inputsTransaction', [GastosController::class, 'inputsTransaction']);
  Route::get('outputsTransaction', [GastosController::class, 'outputsTransaction']);
  Route::get('balanceTransaction', [GastosController::class, 'balanceTransaction']);

  # tcategory
  Route::get('getTCategories', [GastosController::class, 'getTCategories']);
  Route::post('postTCategory', [GastosController::class, 'postTCategory']);
  Route::put('tcategories/{id}', [GastosController::class, 'putTCategory']);
});

Route::post('register', [UserController::class, 'register']); 