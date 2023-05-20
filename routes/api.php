<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubscribeController;
use App\Models\Student;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('student', [StudentController::class,'index']);
Route::post('student', [StudentController::class,'create']);
Route::put('student/{id}', [StudentController::class,'update']);
Route::delete('student/{id}', [StudentController::class,'delete']);

Route::get('test', [StudentController::class,'job']);

Route::post('insert-job', [StudentController::class,'insertJob']);

Route::put('update-job', [StudentController::class,'updateJob']);

Route::get('/show-post', [PostController::class, 'index']);

Route::post('/create-post', [PostController::class, 'store']);

Route::get('/attach', [PostController::class, 'attach']);

Route::get('/detach', [PostController::class, 'detach']);

Route::get('eluquent-test', [PostController::class,'eluqu']);


Route::get('collect', [PostController::class,'collectInfo']);

Route::get('get-many-data', [PostController::class,'getRelation']);

Route::get('subscribed', [SubscribeController::class,'subscribed']);

Route::get('subscribed', [SubscribeController::class,'subscribed']);

Route::get('export', [StudentController::class,'exportFunction']);

Route::get('import', [StudentController::class,'importFunction']);
