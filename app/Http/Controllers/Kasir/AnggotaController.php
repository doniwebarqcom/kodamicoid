<?php

namespace App\Http\Controllers\Kasir;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kodami\Models\Mysql\Users;
use Kodami\Models\Mysql\Deposit;

class AnggotaController extends Controller
{	
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {
    	$data = \App\UserModel::where('access_id', 2)->orderBy('id', 'DESC')->get();

    	return view('kasir.anggota.index', compact('data'));
    }

    /**
     * [detail description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function detail($id)
    {
        $params['data']         = Users::where('id', $id)->first(); 
        $params['transaksi']    = Deposit::where('user_id', $id)->orderBy('id', 'DESC')->get();

        return view('kasir.anggota.detail')->with($params);
    }

   /**
    * [cetakKwitansi description]
    * @param  [type] $id [description]
    * @return [type]     [description]
    */
   public function cetakKwitansi($id)
   {
        $params['data']     = Deposit::where('id', $id)->first();

        return view('kasir.anggota.kwitansi')->with($params);
   }

   /**
    * [topupSimpananPokok description]
    * @param  Request $request [description]
    * @return [type]           [description]
    */
    public function topupSimpananPokok(Request $request)
    {
        $deposit                = new Deposit();
        $deposit->no_invoice    = no_invoice(); 
        $deposit->status        = 3;
        $deposit->type          = 3;
        $deposit->user_id       = $request->user_id;
        $deposit->nominal       = $request->nominal;
        $deposit->proses_user_id = \Auth::user()->id;
        $deposit->save();

        return redirect()->route('kasir.anggota.detail', $request->user_id)->with('message-success', 'Topup Simpanan Pokok berhasil !');
    }

    /**
     * [topupSimpananWajib description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function topupSimpananWajib(Request $request)
    {
        $user                       = Users::where('id', $request->user_id)->first();
        $user->durasi_pembayaran    = $request->durasi_pembayaran;
        $user->first_durasi_pembayaran_date = date('Y-m-d');
        $user->save();

        $deposit                = new \Kodami\Models\Mysql\Deposit();
        $deposit->no_invoice    = no_invoice(); 
        $deposit->status        = 3; 
        $deposit->type          = 5; // Simpanan Wajib
        $deposit->user_id       = $request->user_id;
        $deposit->nominal       = $request->durasi_pembayaran * $request->nominal;
        $deposit->proses_user_id = \Auth::user()->id;
        $deposit->save();

        return redirect()->route('kasir.anggota.detail', $request->user_id)->with('message-success', 'Topup Simpanan Wajib berhasil !');
    }
}
