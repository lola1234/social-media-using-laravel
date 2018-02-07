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

Route::get('/getAuthData', function(){
	return Auth::user();
});

Route::get('/check_relation_status/{id}', 'FriendController@check')->name('check');
Route::get('/add_friend/{id}', 'FriendController@addFriend')->name('addfriend');
Route::get('/accept_friend/{id}', 'FriendController@acceptFriend')->name('acceptfriend');

Route::get('/notifications', 'HomeController@notifications');
Route::get('/get_unread', function(){
	return Auth::user()->unreadNotifications;
});

Route::get('/feed','FeedController@feed');

Route::post('/create/post', 'PostController@store');
Route::get('/like/{id}','LikeController@like');
Route::get('/unlike/{id}','LikeController@unlike');

Route::get('/profile/{slug}', 'ProfileController@index')->name('profile');
Route::get('/profile/edit/profile', 'ProfileController@edit')->name('profile.edit');
Route::post('/profile/update/profile', 'ProfileController@update')->name('profile.update');