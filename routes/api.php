<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactApiController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Controller;

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

Route::get('contacts',[ContactApiController::class,'index']);
Route::post('contacts/store',[ContactApiController::class,'store']);
Route::get('contact/view/{id}',[ContactApiController::class,'view']);
Route::put('contact/update/{id}',[ContactApiController::class,'update']);
Route::delete('contact/delete/{id}',[ContactApiController::class,'delete']);

Route::get('groups',[GroupController::class,'index']);

// show 404 page if route not found
Route::fallback(Controller::class);

