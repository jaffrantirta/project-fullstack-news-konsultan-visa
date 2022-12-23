<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//rate
Route::post('/rate/add', [App\Http\Controllers\FeedbackController::class, 'store']);

//category
Route::post('/category/edit', [App\Http\Controllers\CategoriesController::class, 'show']);

//in-App
Route::get('/news', [App\Http\Controllers\HomeController::class, 'show_news_in_app']);


