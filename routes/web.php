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
Route::post('contact-us', 'HomeController@postContactUs')->name('contact-us');

// ROUTING ADMIN
Route::group(['prefix' => 'admin'], function(){

	$path = "Admin\\";

	Route::get('/', $path . 'IndexController@index')->name('admin.index');
	Route::get('profile', $path . 'UserController@profile');
	Route::get('contact-us', $path.'ContactUsController@index')->name('admin.contact-us');

	Route::resource('user', $path . 'UserController');
	Route::resource('user-group', $path . 'UserGroupController');
	Route::resource('anggota', $path . 'AnggotaController');
});

// ROUTING ANGGOTA
Route::group(['prefix' => 'anggota'], function(){

	$path = "Anggota\\";

	Route::get('/', $path . 'IndexController@index')->name('anggota.index');
	Route::get('profile', $path . 'IndexController@index')->name('anggota.profile');
	Route::get('user/konfirmasi-pembayaran', $path . 'UserController@konfirmasiPembayaran');
	Route::post('user/post-konfirmasi-pembayaran', $path.'UserController@postKonfirmasiPembayaran');
	
	Route::get('user/submit-pembayaran-anggota', $path . 'UserController@submitkonfirmasianggota');
	Route::get('user/post-submit-pembayaran-anggota', $path . 'UserController@submitkonfirmasianggota');
	Route::post('save-profile', $path.'IndexController@saveProfile')->name('anggota.index.save.profile');
	Route::get('bayar', $path.'BayarController@step1');
	Route::get('rekening-bank', $path. 'RekeningBankController@index')->name('anggota.rekening-bank');
	Route::get('rekening-bank/create', $path. 'RekeningBankController@create')->name('anggota.rekening-bank.create');

});

Auth::routes();

/* old */
Route::get('register-v2', 'RegisterController@v2');
