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
Route::post('ajax/add-rekening-bank', 'AjaxController@addRekeningBank')->name('ajax.add.rekening.bank');

// ROUTING ADMIN
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'access:1']], function(){

	$path = "Admin\\";

	Route::get('/', $path . 'IndexController@index')->name('admin.index');
	Route::get('profile', $path . 'UserController@profile');
	Route::get('contact-us', $path.'ContactUsController@index')->name('admin.contact-us');

	Route::resource('user', $path . 'UserController');
	Route::resource('user-group', $path . 'UserGroupController');
	Route::resource('anggota', $path . 'AnggotaController');

	Route::resource('bank', $path.'BankController');
	Route::resource('rekening-bank', $path.'RekeningBankController');

	Route::get('bayar/approve/{id}', $path.'BayarAdminController@approve')->name('admin.bayar.approve');
	Route::get('bayar/denied/{id}', $path.'BayarAdminController@denied')->name('admin.bayar.denied');
});

// ROUTING ANGGOTA
Route::group(['prefix' => 'anggota', 'middleware' => ['auth', 'access:2']], function(){

	$path = "Anggota\\";

	Route::get('/', $path . 'IndexController@index')->name('anggota.dashboard');
	Route::get('profile', $path . 'IndexController@profile')->name('anggota.profile');
	Route::get('user/konfirmasi-pembayaran', $path . 'UserController@konfirmasiPembayaran');
	Route::post('user/post-konfirmasi-pembayaran', $path.'UserController@postKonfirmasiPembayaran');
	
	Route::get('user/submit-pembayaran-anggota', $path . 'UserController@submitkonfirmasianggota');
	Route::get('user/post-submit-pembayaran-anggota', $path . 'UserController@submitkonfirmasianggota');
	Route::post('save-profile', $path.'IndexController@saveProfile')->name('anggota.index.save.profile');
	Route::get('bayar', $path.'BayarController@step1');
	Route::post('anggota/bayar/submit', $path.'BayarController@submit')->name('anggota.bayar.submit');
	Route::resource('rekening-bank-user', $path. 'RekeningBankUserController');
	Route::post('upload-confirmation', $path.'BayarController@confirmation')->name('anggota.upload.confirmation');
});


// ROUTING OPERATOR
Route::group(['prefix' => 'operator', 'middleware' => ['auth', 'access:5']], function(){

	$path = 'Operator\\';

	Route::get('/', $path .'IndexController@index')->name('operator.dashboard');
});

// ROUTING ADMIN OPERATOR
Route::group(['prefix' => 'admin-operator', 'middleware' => ['auth', 'access:6']], function(){

	$path = 'AdminOperator\\';

	Route::get('/', $path .'IndexController@index')->name('admin.operator.dashboard');
});

Auth::routes();

/* old */
Route::get('register-v2', 'RegisterController@v2');

