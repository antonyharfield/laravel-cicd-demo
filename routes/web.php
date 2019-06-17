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

// [1] Create a profile page
Route::get('/profile', 'UserController@profile')->name('profile');

// [2] Redirect to Kiddiary authorise page
Route::get('/profile/connect', 'UserController@connect');

// [3] Receive the call from Kiddiary
Route::get('/auth/callback', 'UserController@connectCallback')->name('callback');

// 
Route::get('/profile/disconnect', 'UserController@disconnect');
