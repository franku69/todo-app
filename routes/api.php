<?php

use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('add-product',[TodoController::class,'adding']);
Route::put('edit-product',[TodoController::class,'edited']);
Route::delete('delete-product',[TodoController::class,'deleted']);
Route::get('getdata',[TodoController::class,'getData']);