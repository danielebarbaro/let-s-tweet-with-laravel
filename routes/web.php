<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::post('/tweets', 'Tweets\TweetsController@store')->name('tweets.store');

    Route::post('/following', 'Users\FollowingController@store')->name('following.store');
    Route::delete('/following/{username}', 'Users\FollowingController@destroy')->name('following.destroy');

    Route::get('/{username}/followers', 'Users\UserFollowersController@index')->name('user-followers.index');
    Route::get('/{username}/following', 'Users\UserFollowingController@index')->name('user-following.index');
});

Route::get('/{username}', 'Users\UsersController@show')->name('users.show');
