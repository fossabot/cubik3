<?php

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

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');

Route::get('/users/@{user:username}', 'UserController@show');
Route::get('/users/@{user:username}/posts', 'PostController@showUser');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/users/@{user:username}/follow', 'UserController@follow');
    Route::post('/users/@{user:username}/unfollow', 'UserController@unfollow');
    Route::get('/users/@{user:username}/following', 'UserController@following');
    Route::get('/users/@{user:username}/followers', 'UserController@followers');

    Route::get('/posts', 'PostController@index');
    Route::post('/posts', 'PostController@store');
    Route::get('/posts/{post}', 'PostController@show');

    Route::get('/notifications', 'NotificationController@index');
});
