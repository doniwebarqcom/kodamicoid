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

	$pathAnggota = "Admin\\";

	Route::get('/', $pathAnggota . 'IndexController@index');
	Route::get('profile', $pathAnggota . 'UserController@profile');
	
	Route::resource('user', $pathAnggota . 'UserController');
	Route::resource('user-group', $pathAnggota . 'UserGroupController');
	Route::resource('anggota', $pathAnggota . 'AnggotaController');

});

// ROUTING ANGGOTA
Route::group(['prefix' => 'anggota'], function(){

	$pathAnggota = "Anggota\\";

	Route::get('/', $pathAnggota . 'IndexController@index');
	Route::get('profile', $pathAnggota . 'IndexController@index');
	Route::get('user/konfirmasi-pembayaran', $pathAnggota . 'UserController@konfirmasiPembayaran');
	Route::post('user/post-konfirmasi-pembayaran', $pathAnggota.'UserController@postKonfirmasiPembayaran');
	
	Route::get('user/submit-pembayaran-anggota', $pathAnggota . 'UserController@submitkonfirmasianggota');
	Route::get('user/post-submit-pembayaran-anggota', $pathAnggota . 'UserController@submitkonfirmasianggota');

	
});

Auth::routes();

/* old */
Route::get('register-v2', 'RegisterController@v2');