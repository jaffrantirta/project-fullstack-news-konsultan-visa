<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);;

Route::get('/admin', [App\Http\Controllers\DashboardController::class, 'index']);

//homepage
Route::get('/', [App\Http\Controllers\HomeController::class, 'homepage']);
Route::get('/search', [App\Http\Controllers\HomeController::class, 'search']);
Route::get('/news', [App\Http\Controllers\HomeController::class, 'category']);
Route::get('/subscribe', [App\Http\Controllers\HomeController::class, 'set_subs']);
Route::get('/read', [App\Http\Controllers\HomeController::class, 'show']);

//login
Route::get('/sign-in', function () {
    return view('administrator.login');
});

//rate
Route::get('/rate', [App\Http\Controllers\PlaceController::class, 'index']);

Route::group(['middleware' => ['role:Super-Admin']], function () {
    //category
    Route::get('/admin/category', [App\Http\Controllers\CategoriesController::class, 'index']);
    Route::post('/admin/category/add', [App\Http\Controllers\CategoriesController::class, 'store']);
    Route::post('/admin/category/delete', [App\Http\Controllers\CategoriesController::class, 'destroy']);
    Route::post('/admin/category/edit/{id}', [App\Http\Controllers\CategoriesController::class, 'update']);

    //youtube
    Route::get('/admin/youtube', [App\Http\Controllers\YoutubeController::class, 'index']);
    Route::post('/admin/youtube/add', [App\Http\Controllers\YoutubeController::class, 'store']);
    Route::get('/admin/youtube/delete/{id}', [App\Http\Controllers\YoutubeController::class, 'destroy']);
    Route::post('/admin/youtube/edit/{id}', [App\Http\Controllers\YoutubeController::class, 'update']);

    //ads
    Route::get('/admin/ads', [App\Http\Controllers\AdController::class, 'index']);
    Route::post('/admin/ads/add', [App\Http\Controllers\AdController::class, 'store']);
    Route::get('/admin/ads/delete/{id}', [App\Http\Controllers\AdController::class, 'destroy']);
    Route::post('/admin/ads/edit/{id}', [App\Http\Controllers\AdController::class, 'update']);

    //question
    Route::get('/admin/question', [App\Http\Controllers\QuestionController::class, 'index']);
    Route::post('/admin/question/add', [App\Http\Controllers\QuestionController::class, 'store']);
    Route::get('/admin/question/delete/{id}', [App\Http\Controllers\QuestionController::class, 'destroy']);
    Route::post('/admin/question/edit/{id}', [App\Http\Controllers\QuestionController::class, 'update']);

    //answer
    Route::get('/admin/answer/{id}', [App\Http\Controllers\AnswerController::class, 'index']);
    Route::post('/admin/answer/add', [App\Http\Controllers\AnswerController::class, 'store']);
    Route::post('/admin/answer/edit/{id}', [App\Http\Controllers\AnswerController::class, 'update']);

    //premium
    Route::get('/admin/premium', [App\Http\Controllers\PremiumController::class, 'index']);
    Route::post('/admin/premium/add', [App\Http\Controllers\PremiumController::class, 'store']);

    //sosial media
    Route::get('/admin/socmed', [App\Http\Controllers\SocialMediaController::class, 'index']);
    Route::post('/admin/socmed/add', [App\Http\Controllers\SocialMediaController::class, 'store']);
    Route::get('/admin/socmed/delete/{id}', [App\Http\Controllers\SocialMediaController::class, 'destroy']);
    Route::post('/admin/socmed/edit/{id}', [App\Http\Controllers\SocialMediaController::class, 'update']);

    //user
    Route::get('/admin/users', [App\Http\Controllers\UserController::class, 'index']);
    Route::post('/admin/users/add', [App\Http\Controllers\UserController::class, 'store']);
    Route::post('/admin/users/delete', [App\Http\Controllers\UserController::class, 'destroy']);
    Route::post('/admin/users/edit/{id}', [App\Http\Controllers\UserController::class, 'update']);
    Route::post('/admin/users/check', [App\Http\Controllers\UserController::class, 'check']);

    //add trending
    Route::get('/add_trending/top', [App\Http\Controllers\TrendingTopController::class, 'add_to_trending']);
    Route::get('/add_trending/bottom', [App\Http\Controllers\TrendingBottomController::class, 'add_to_trending']);
});

Route::group(['middleware' => ['role:Super-Admin|writer']], function () {
    //post
    Route::get('/admin/post', [App\Http\Controllers\PostsController::class, 'index']);
    Route::get('/admin/post/add', [App\Http\Controllers\PostsController::class, 'show']);
    Route::post('/admin/post/delete', [App\Http\Controllers\PostsController::class, 'destroy']);
    Route::get('/admin/post/edit/{id}', [App\Http\Controllers\PostsController::class, 'edit']);
    Route::post('/post/edit/process/{id}', [App\Http\Controllers\PostsController::class, 'update']);
    Route::get('/category/post/{post_id}', [App\Http\Controllers\CategoriesController::class, 'category_select']);
    Route::post('/post/add', [App\Http\Controllers\PostsController::class, 'store']);
    Route::get('/post/unactive/{url}', [App\Http\Controllers\PostsController::class, 'unactive']);
    Route::get('/post/active/{url}', [App\Http\Controllers\PostsController::class, 'active']);
});

Route::group(['middleware' => ['role:Super-Admin|user-point']], function () {
    //reviews
    Route::get('/admin/review/{id}', [App\Http\Controllers\RatingController::class, 'index']);

    //point
    Route::get('/admin/point', [App\Http\Controllers\BuildingController::class, 'index']);
    Route::post('/admin/point/add', [App\Http\Controllers\BuildingController::class, 'store']);
    Route::post('/admin/point/delete', [App\Http\Controllers\BuildingController::class, 'destroy']);
    Route::post('/admin/point/edit/{id}', [App\Http\Controllers\BuildingController::class, 'update']);

    //toilet
    Route::get('/admin/{id}/toilet', [App\Http\Controllers\ToiletController::class, 'index']);
    Route::post('/admin/toilet/delete', [App\Http\Controllers\ToiletController::class, 'destroy']);
    Route::post('/admin/toilet/edit/{id}', [App\Http\Controllers\ToiletController::class, 'update']);
    Route::post('/admin/{id}/toilet/add', [App\Http\Controllers\ToiletController::class, 'store']);
    Route::post('/admin/download/rating', [App\Http\Controllers\RatingController::class, 'export']);
    Route::post('/admin/download/question', [App\Http\Controllers\RatingController::class, 'export_feedback']);

    //report
    Route::get('/admin/export', [App\Http\Controllers\FeedbackController::class, 'export']);
    Route::get('/admin/test', [App\Http\Controllers\FeedbackController::class, 'test']);

    //QR toilet
    Route::get('/admin/{id}/qr/print', [App\Http\Controllers\SelectedToiletController::class, 'index']);
});

Route::group(['middleware' => ['role:Super-Admin|user-point|writer']], function () {
    Route::get('/admin/profile', [App\Http\Controllers\UserController::class, 'profile']);
    Route::post('/admin/profile/update', [App\Http\Controllers\UserController::class, 'update_profile']);
    Route::post('/admin/profile/update/password', [App\Http\Controllers\UserController::class, 'change_password']);

    //dashboard
    Route::get('/get_statistic', [App\Http\Controllers\DashboardController::class, 'top_news']);
});




