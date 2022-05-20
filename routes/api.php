<?php
use App\Http\Controllers\UserController;

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\user;
use App\Models\products;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [UserController::class,'register']);
Route::post('/login', [UserController::class,'login']);
//Route::post('/logout', [UserController::class,'logout']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    //Route::post('/logout', [UserController::class,'logout']);
});
Route::post('/auth/logout',[UserController::class,'logout'])->middleware('auth:sanctum');
Route::get('/products', [ProductController::class, 'getAllproducts']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/product', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);