<?php

namespace App\Http\Controllers\Dropshiper;

use Illuminate\Http\Request;
use App\Http\Controllers\ControllerLogin;
use App\Http\Controllers\Controller;
use Auth;

class UserController extends ControllerLogin
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {
    	return view('dropshiper.index');
    }

    /**
     * [konfirmasiAnggota description]
     * @return [type] [description]
     */
    public function konfirmasiPembayaran()
    {
    	return view('dropshiper.user.konfirmasi-pembayaran');
    }
    
    /**
     * [postKonfirmasiAnggota description]
     * @return [type] [description]
     */
    public function postKonfirmasiPembayaran()
    {
    	request()->validate([
    		'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    	]);


    	$imageName = time().'.'.request()->image->getClientOriginalExtension();

        request()->image->move(public_path('images'), $imageName);
        
    	return redirect('dropshiper')->with('messages', 'Konfirmasi pembayaran anda berhasil, silahkan menunggu sistem akan mengecek bukti pembayaran anda terlebih dahulu.');
    } 
}
