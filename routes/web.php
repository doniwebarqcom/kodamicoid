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

date_default_timezone_set("Asia/Bangkok");

function route_index()
{
	if(Auth::check())
    {
        if(Auth::user()->access_id == 2) // Anggota
        {
            return redirect()->route('anggota.dashboard');
        }

        if(Auth::user()->access_id == 1) // Admin
        {
            return redirect()->route('admin.index');
        }

        if(Auth::user()->access_id == 4) // CS
        {
            return redirect()->route('cs.index');
        }
    }
}

Route::get('/', function () {
    
	route_index();
    
    return view('welcome');
});

Route::get('home', function () {
	
	route_index();
	
    return view('welcome');
});

Route::get('register/success', 'RegisterController@success');

// Routing Menu Products
Route::get('register', 'RegisterController@index');
Route::post('registerPost', 'RegisterController@registerPost');
Route::get('logout', 'Auth\LoginController@logout');
Route::post('contact-us', 'HomeController@postContactUs')->name('contact-us');
Route::post('ajax/add-rekening-bank', 'AjaxController@addRekeningBank')->name('ajax.add.rekening.bank');

Route::post('moota-push', 'Admin\MootaPushController@index')->name('admin.moota-push');

// ROUTING LOGIN
Route::group(['middleware' => ['auth']], function(){
	/**
	 * Ajax
	 */
	Route::post('ajax/get-kabupaten-by-provinsi', 'AjaxController@getKabupatenByProvinsi')->name('ajax.get-kabupaten-by-provinsi-id');
	Route::post('ajax/get-kecamatan-by-kabupaten', 'AjaxController@getKecamatanByKabupaten')->name('ajax.get-kecamatan-by-kabupaten-id');
	Route::post('ajax/get-kelurahan-by-kecamatan', 'AjaxController@getKelurahanByKecamatan')->name('ajax.get-kelurahan-by-kecamatan-id');

	/**
	 * Ajax Admin
	 */
	Route::post('ajax-admin/submit-simpanan-sukarela', 'AjaxAdminController@submitSimpananSukarela')->name('ajax.admin.submit-simpanan-sukarela');
});

// ROUTING ADMIN
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'access:1']], function(){

	$path = "Admin\\";

	Route::get('/', $path . 'IndexController@index')->name('admin.index');
	Route::get('profile', $path . 'UserController@profile')->name('admin.profile');
	Route::get('contact-us', $path.'ContactUsController@index')->name('admin.contact-us');

	Route::resource('user', $path . 'UserController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'admin']);
	Route::resource('user-group', $path . 'UserGroupController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'user-group']);

	/* MOOTA */
	Route::get('moote-bank', $path .'MootaBankController@index')->name('admin.moota-bank.index');
	Route::get('moote-bank-mutasi/{bank_id}/{bank_type}', $path .'MootaBankController@mutasi')->name('admin.moota-bank.mutasi');
	

	/** END  */


	/**
	 * Routing Anggota
	 */
	Route::resource('anggota', $path . 'AnggotaController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'admin']);
	Route::resource('simpanan-sukarela', $path . 'SimpananSukarelaController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'admin']);
	Route::resource('simpanan-pokok', $path . 'SimpananPokokController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'admin']);
	Route::resource('simpanan-wajib', $path . 'SimpananWajibController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'admin']);

	Route::get('anggota/cetak-kwitansi/{id}', $path .'AnggotaController@cetakKwitansi')->name('admin.anggota.cetak-kwitansi');
	Route::post('anggota/topup-simpanan-pokok', $path .'AnggotaController@topupSimpananPokok')->name('admin.anggota.topup-simpanan-pokok');
	Route::post('anggota/topup-simpanan-wajib', $path .'AnggotaController@topupSimpananWajib')->name('admin.anggota.topup-simpanan-wajib');
	/* End Routing Anggota*/


	Route::resource('bank', $path.'BankController');
	Route::resource('rekening-bank', $path.'RekeningBankController');
	Route::resource('setting', $path.'SettingController',['as' => 'admin']);

	Route::get('bayar/approve/{id}', $path.'BayarAdminController@approve')->name('admin.bayar.approve');
	Route::get('bayar/denied/{id}', $path.'BayarAdminController@denied')->name('admin.bayar.denied');
	Route::get('anggota/confirm/{id}', $path .'AnggotaController@confirm')->name('admin.anggota.confirm');
	Route::post('anggota/confirm-submit', $path .'AnggotaController@confirmSubmit')->name('admin.anggota.confirm-submit');
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
	
	Route::get('bayar', $path.'BayarController@step1')->name('anggota.bayar');
	Route::post('submitstep1', $path.'BayarController@submitStep1')->name('anggota.submit-step1');

	Route::post('anggota/bayar/submit', $path.'BayarController@submit')->name('anggota.bayar.submit');
	Route::post('anggota/add-rekening-bank', $path. 'BayarController@addRekeningBank')->name('anggota.bayar.add-rekening-bank');

	Route::resource('rekening-bank-user', $path. 'RekeningBankUserController');
	Route::post('upload-confirmation', $path.'BayarController@confirmation')->name('anggota.upload.confirmation');
	Route::resource('simpanan-sukarela', $path. 'SimpananSukarelaController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'anggota']);
});

// ROUTING TELLER / KASIR
Route::group(['prefix' => 'kasir', 'middleware' => ['auth', 'access:3']], function(){
	$path = "Kasir\\";

	Route::get('/', $path .'IndexController@index')->name('kasir.index');
	Route::resource('anggota', $path . 'AnggotaController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'kasir']);
});

// ROUTING TELLER / KASIR
Route::group(['prefix' => 'cs', 'middleware' => ['auth', 'access:4']], function(){
	$path = "Cs\\";

	Route::get('/', $path .'IndexController@index')->name('cs.index');
	Route::resource('anggota', $path . 'AnggotaController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'cs']);
});

Auth::routes();

/* old */
Route::get('register-v2', 'RegisterController@v2');

