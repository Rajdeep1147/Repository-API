<?php

use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\BlogController;

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

Route::middleware('auth:api')->get('/blog', function (Request $request) {
    return $request->user();
});

Route::get('jobs',[StudentController::class,'job']);
Route::get('category',[BlogController::class,'index']);
Route::post('category',[BlogController::class,'create']);
Route::put('category/{id}',[BlogController::class,'update']);
Route::delete('category/{id}',[BlogController::class,'destroy']);
Route::get('category/search/{search}',[BlogController::class,'search']);
Route::get('category/filter/{filter}/{search?}',[BlogController::class,'filter']);




