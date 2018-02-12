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

Route::get('home', function () {
    return view('welcome');
});

Route::get('register/success', 'RegisterController@success');

// Routing Menu Products
Route::get('register', 'RegisterController@index');
Route::post('registerPost', 'RegisterController@registerPost');
Route::get('logout', 'Auth\LoginController@logout');

// ROUTING ADMIN
Route::group(['prefix' => 'admin'], function(){

	$pathAnggota = "admin\\";

	Route::get('/', $pathAnggota . 'IndexController@index');
	Route::get('profile', $pathAnggota . 'UserController@profile');

});

// ROUTING ANGGOTA
Route::group(['prefix' => 'anggota'], function(){

	$pathAnggota = "anggota\\";

	Route::get('/', $pathAnggota . 'IndexController@index');
	Route::get('profile', $pathAnggota . 'IndexController@index');
	Route::get('user/konfirmasi-pembayaran-anggota', $pathAnggota . 'UserController@konfirmasianggota');
	
});

Auth::routes();

/* old */
Route::get('register-v2', 'RegisterController@v2');