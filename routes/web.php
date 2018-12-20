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

Route::get('/', function () {
	
	if(Auth::check())
    {
        if(Auth::user()->access_id == 2) // Anggota
        {
            return redirect()->route('anggota.dashboard');
        }

        if(Auth::user()->access_id == 1) // Admin
        {
            return redirect()->route('admin.dashboard');
        }

        if(Auth::user()->access_id == 4) // CS
        {
            return redirect()->route('cs.index');
        }
        
        if(Auth::user()->access_id == 7) // CS
        {
            return redirect()->route('dropshiper.dashboard');
        }
    }
    if(isMobileDevice())
    {
    	return view('layout.mobile');
    }
    else
    {
    	return view('welcome');
    }
});
Route::get('home', function () {
	if(Auth::check())
    {
        if(Auth::user()->access_id == 2) // Anggota
        {
            return redirect()->route('anggota.dashboard');
        }

        if(Auth::user()->access_id == 1) // Admin
        {
            return redirect()->route('admin.dashboard');
        }

        if(Auth::user()->access_id == 4) // CS
        {
            return redirect()->route('cs.index');
        }

        if(Auth::user()->access_id == 7) // CS
        {
            return redirect()->route('dropshiper.dashboard');
        }
    }

    if(isMobileDevice())
    {
    	return view('layout.mobile');
    }
    else
    {
    	return view('welcome');
    }
});

Route::get('register/success', 'RegisterController@success');
Route::get('register', 'RegisterController@index');
Route::get('logout', 'Auth\LoginController@logout');
Route::post('registerPost', 'RegisterController@registerPost');
Route::post('contact-us', 'HomeController@postContactUs')->name('contact-us');
Route::post('ajax/add-rekening-bank', 'AjaxController@addRekeningBank')->name('ajax.add.rekening.bank');
Route::get('konfirmasi/{aktivasi_code}', 'HomeController@konfirmasi')->name('konfirmasi');
Route::post('konfirmasi-store/{id}', 'HomeController@konfirmasiStore')->name('konfirmasi-store');

Route::get('daftar', 'HomeController@daftar')->name('daftar');
Route::post('daftar-store', 'HomeController@daftarStore')->name('daftar-store');

// ROUTING LOGIN
// Route::group(['middleware' => ['auth']], function(){
	Route::post('ajax/get-kabupaten-by-provinsi', 'AjaxController@getKabupatenByProvinsi')->name('ajax.get-kabupaten-by-provinsi-id');
	Route::post('ajax/get-kecamatan-by-kabupaten', 'AjaxController@getKecamatanByKabupaten')->name('ajax.get-kecamatan-by-kabupaten-id');
	Route::post('ajax/get-kelurahan-by-kecamatan', 'AjaxController@getKelurahanByKecamatan')->name('ajax.get-kelurahan-by-kecamatan-id');
	Route::post('ajax-admin/submit-simpanan-sukarela', 'AjaxAdminController@submitSimpananSukarela')->name('ajax.admin.submit-simpanan-sukarela');
	Route::post('ajax/get-anggota', 'AjaxController@getAnggota')->name('ajax.get-anggota');
	Route::post('ajax/get-anggota-by-id', 'AjaxController@getAnggotaById')->name('ajax.get-anggota-by-id');
	Route::post('ajax/get-anggota-by-id-html', 'AjaxController@getAnggotaByIdHtml')->name('ajax.get-anggota-by-id-html');
// });
// 	
// ROUTING ADMIN
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'access:1']], function(){
	Route::get('/','IndexController@index')->name('admin.index');
	Route::get('/','IndexController@index')->name('admin.dashboard');
	Route::get('profile','UserController@profile')->name('admin.profile');
	Route::get('contact-us','ContactUsController@index')->name('admin.contact-us');
	Route::get('autologin/{id}','AnggotaController@autologin')->name('admin.autologin');
	Route::get('moote-bank','MootaBankController@index')->name('admin.moota-bank.index');
	Route::get('moote-bank-mutasi/{bank_id}/{bank_type}','MootaBankController@mutasi')->name('admin.moota-bank.mutasi');
	Route::get('user/delete-bank/{id}/{user_id}','AnggotaController@deleteBank')->name('admin.user.delete-bank');
	Route::get('bayar/approve/{id}','BayarAdminController@approve')->name('admin.bayar.approve');
	Route::get('bayar/denied/{id}','BayarAdminController@denied')->name('admin.bayar.denied');
	Route::get('anggota/confirm/{id}','AnggotaController@confirm')->name('admin.anggota.confirm');
	Route::get('rekening-bank/mutasi/{id}','RekeningBankController@mutasi')->name('admin.rekening-bank.mutasi');
	Route::get('setting','IndexController@setting')->name('admin.setting.index');
	Route::get('user/autologin/{id}','UserController@autologin')->name('admin.user.autologin');
	Route::get('anggota/cetak-kwitansi/{id}','AnggotaController@cetakKwitansi')->name('admin.anggota.cetak-kwitansi');
	Route::get('anggota/destroy/{id}', 'AnggotaController@destroy')->name('admin.anggota.destroy');
    Route::get('kemitraan/add-kuota/{id}','KemitraanController@addKuota')->name('admin.kemitraan.add-kuota');
    Route::get('kemitraan/dropshiper-active/{id}','KemitraanController@dropshiperActive')->name('admin.kemitraan.dropshiper-active');
    Route::get('kemitraan/dropshiper-inactive/{id}','KemitraanController@dropshiperInactive')->name('admin.kemitraan.dropshiper-inactive');
	Route::get('active/{id}','AnggotaController@active')->name('admin.anggota.active');
	Route::get('inactive/{id}','AnggotaController@inactive')->name('admin.anggota.inactive');
	Route::post('anggota/topup-simpanan-pokok','AnggotaController@topupSimpananPokok')->name('admin.anggota.topup-simpanan-pokok');
	Route::post('anggota/topup-simpanan-wajib','AnggotaController@topupSimpananWajib')->name('admin.anggota.topup-simpanan-wajib');
	Route::post('anggota/add-rekening-bank','AnggotaController@addRekeningBank')->name('admin.anggota.add-rekening-bank');
	Route::post('anggota/confirm-submit','AnggotaController@confirmSubmit')->name('admin.anggota.confirm-submit');
	Route::resource('user','UserController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'admin']);
	Route::resource('user-group','UserGroupController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'user-group']);
	Route::resource('bank','BankController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'admin']);
	Route::resource('rekening-bank','RekeningBankController',['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'admin']);
	Route::resource('anggota','AnggotaController', ['only'=> ['index','create','store', 'edit','update'], 'as' => 'admin']);
	Route::resource('simpanan-sukarela','SimpananSukarelaController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'admin']);
	Route::resource('simpanan-pokok','SimpananPokokController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'admin']);
	Route::resource('simpanan-wajib','SimpananWajibController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'admin']);
	Route::resource('kemitraan','KemitraanController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'admin']);
	Route::resource('general-setting','SettingController',['as' => 'admin']);
});

// ROUTING ANGGOTA
Route::group(['prefix' => 'anggota', 'namespace' => 'Anggota', 'middleware' => ['auth', 'access:2']], function(){
	Route::get('/','IndexController@index')->name('anggota.dashboard');
	Route::get('profile','IndexController@profile')->name('anggota.profile');
	Route::get('user/konfirmasi-pembayaran','UserController@konfirmasiPembayaran');
	Route::get('user/submit-pembayaran-anggota','UserController@submitkonfirmasianggota');
	Route::get('user/post-submit-pembayaran-anggota','UserController@submitkonfirmasianggota');
	Route::get('bayar','BayarController@step1')->name('anggota.bayar');
	Route::get('back-to-admin','IndexController@backtoadmin')->name('anggota.back-to-admin');
	Route::post('user/post-konfirmasi-pembayaran','UserController@postKonfirmasiPembayaran');
	Route::post('save-profile','IndexController@saveProfile')->name('anggota.index.save.profile');
	Route::post('submitstep1','BayarController@submitStep1')->name('anggota.submit-step1');
	Route::post('anggota/bayar/submit','BayarController@submit')->name('anggota.bayar.submit');
	Route::post('anggota/add-rekening-bank','BayarController@addRekeningBank')->name('anggota.bayar.add-rekening-bank');
	Route::post('upload-confirmation','BayarController@confirmation')->name('anggota.upload.confirmation');\
	Route::resource('rekening-bank-user','RekeningBankUserController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'anggota']);
	Route::resource('simpanan-sukarela','SimpananSukarelaController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'anggota']);
});

// ROUTING DROPSHIPER
Route::group(['prefix' => 'dropshiper', 'namespace' => 'Dropshiper', 'middleware' => ['auth', 'access:7']], function(){
	Route::get('/','IndexController@index')->name('dropshiper.dashboard');
	Route::get('profile','IndexController@profile')->name('dropshiper.profile');
	Route::get('user/konfirmasi-pembayaran','UserController@konfirmasiPembayaran')->name('dropshiper.user.konfirmasi-pembayaran');
	Route::get('user/submit-pembayaran-anggota','UserController@submitkonfirmasianggota')->name('dropshiper.user.submit-pembayaran-anggota');
	Route::get('user/post-submit-pembayaran-anggota','UserController@submitkonfirmasianggota')->name('dropshiper.user.post-submit-pembayaran-anggota');
	Route::get('bayar','BayarController@step1')->name('dropshiper.bayar');
	Route::get('back-to-admin','IndexController@backtoadmin')->name('dropshiper.back-to-admin');
	Route::post('user/post-konfirmasi-pembayaran','UserController@postKonfirmasiPembayaran');
	Route::post('save-profile','IndexController@saveProfile')->name('dropshiper.index.save.profile');
	Route::post('submitstep1','BayarController@submitStep1')->name('dropshiper.submit-step1');
	Route::post('anggota/bayar/submit','BayarController@submit')->name('dropshiper.bayar.submit');
	Route::post('anggota/add-rekening-bank','BayarController@addRekeningBank')->name('dropshiper.bayar.add-rekening-bank');
	Route::post('upload-confirmation','BayarController@confirmation')->name('dropshiper.upload.confirmation');\
	Route::resource('rekening-bank-user','RekeningBankUserController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'dropshiper']);
	Route::resource('simpanan-sukarela','SimpananSukarelaController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'dropshiper']);
});

// ROUTING TELLER / KASIR
Route::group(['prefix' => 'kasir', 'namespace' => 'Kasir', 'middleware' => ['auth', 'access:3']], function(){
	Route::get('/','IndexController@index')->name('kasir.index');
	Route::get('back-to-admin','IndexController@backtoadmin')->name('kasir.back-to-admin');
	Route::get('anggota/detail/{id}','AnggotaController@detail')->name('kasir.anggota.detail');
	Route::get('anggota/cetak-kwitansi/{id}/{jenis_transaksi}','AnggotaController@cetakKwitansi')->name('kasir.anggota.cetak-kwitansi');
	Route::post('anggota/topup-simpanan-pokok', 'AnggotaController@topupSimpananPokok')->name('kasir.anggota.topup-simpanan-pokok');
	Route::post('anggota/topup-simpanan-wajib', 'AnggotaController@topupSimpananWajib')->name('kasir.anggota.topup-simpanan-wajib');
	Route::post('anggota/topup-simpanan-sukarela', 'AnggotaController@topupSimpananSukarela')->name('kasir.anggota.topup-simpanan-sukarela');
	Route::post('ajax/submit-simpanan-sukarela', 'AjaxController@submitSimpananSukarela')->name('ajax.kasir.submit-simpanan-sukarela');
	Route::resource('anggota','AnggotaController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'kasir']);
});

// ROUTING CS
Route::group(['prefix' => 'cs', 'namespace' => 'Cs', 'middleware' => ['auth', 'access:4']], function(){
	Route::get('/','IndexController@index')->name('cs.index');
	Route::get('back-to-admin','IndexController@backtoadmin')->name('cs.back-to-admin');
	Route::get('active/{id}','AnggotaController@active')->name('cs.anggota.active');
	Route::get('inactive/{id}','AnggotaController@inactive')->name('cs.anggota.inactive');
	Route::resource('anggota','AnggotaController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'cs']);
	Route::resource('simpanan-wajib','SimpananWajibController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'cs']);
	Route::resource('simpanan-pokok','SimpananPokokController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'cs']);
	Route::resource('simpanan-sukarela','SimpananSukarelController', ['only'=> ['index','create','store', 'edit','destroy','update'], 'as' => 'cs']);
});
Auth::routes();
?>