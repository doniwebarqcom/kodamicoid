<?php

namespace App\Http\Controllers\Kasir;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kodami\Models\Mysql\Users;
use Kodami\Models\Mysql\Deposit;
use Kodami\Models\Mysql\PPulsaTransaksi;

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
        $deposit                = Deposit::select('id','user_id','nominal','created_at', \DB::raw(' 0 as jenis_transaksi'),'type','no_invoice')->where('user_id', $id)->orderBy('id', 'DESC')->get(); 
        $pulsa                  = PPulsaTransaksi::select('id','user_id',\DB::raw('harga_beli as nominal'), 'created_at', \DB::raw('1 as jenis_transaksi'), \DB::raw('p_pulsa_id as type'),'no_invoice')->where('user_id', $id)->orderBy('id', 'DESC')->get(); 
        
        $params['data']         = Users::where('id', $id)->first(); 
        $params['transaksi']    = $deposit->union($pulsa);

        return view('kasir.anggota.detail')->with($params);
    }

   /**
    * [cetakKwitansi description]
    * @param  [type] $id [description]
    * @return [type]     [description]
    */
   public function cetakKwitansi($id, $jenis_transaksi)
   {
        $params['jenis_transaksi'] = $jenis_transaksi;

        if($jenis_transaksi == 1)
        {
            $params['data']       = PPulsaTransaksi::where('id', $id)->first();
        }
        else
        {
            $params['data']     = Deposit::where('id', $id)->first();
        }

        return view('kasir.anggota.kwitansi')->with($params);
   }

   /**
    * [topupSimpananPokok description]
    * @param  Request $request [description]
    * @return [type]           [description]
    */
    public function topupSimpananPokok(Request $request)
    {
        $user                       = Users::where('id', $request->user_id)->first();
        # cek jika profile belum lengkap
        if($user->domisili_kelurahan_id === NULL)
        {
            return redirect()->route('kasir.anggota.detail', $request->user_id)->with('message-error', 'Pembayaran belum bisa dilakukan alamat domisili Anda belum lengkap, silahkan hubungi Customer Service untuk melengkapi data Anda. !'); 
        }
        if($user->tanggal_lahir === NULL)
        {
            return redirect()->route('kasir.anggota.detail', $request->user_id)->with('message-error', 'Pembayaran belum bisa dilakukan tanggal lahir Anda belum lengkap, silahkan hubungi Customer Service untuk melengkapi data Anda. !'); 
        }

        $deposit                = new Deposit();
        $deposit->no_invoice    = no_invoice(); 
        $deposit->status        = 3;
        $deposit->type          = 3;
        $deposit->user_id       = $request->user_id;
        $deposit->nominal       = remove_number_format($request->nominal);
        $deposit->proses_user_id = \Auth::user()->id;
        $deposit->save();

        # cek simpanan wajib
        $cek = Deposit::where('status',3)->where('user_id', $request->user_id)->where('type', 5)->count();
        if($cek > 0)
        {
            $no_anggota = generate_no_anggota($request->user_id);

            if($no_anggota['status'] == 'success')
            {
                # set no anggota
                Users::where('id', $request->user_id)->update(['no_anggota', $no_anggota['data']]);
            }
        }

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

        # cek jika profile belum lengkap
        if($user->domisili_kelurahan_id === NULL)
        {
            return redirect()->route('kasir.anggota.detail', $request->user_id)->with('message-error', 'Pembayaran belum bisa dilakukan alamat domisili Anda belum lengkap, silahkan hubungi Customer Service untuk melengkapi data Anda. !'); 
        }
        if($user->tanggal_lahir === NULL || $user->domisili_kelurahan_id === NULL)
        {
            return redirect()->route('kasir.anggota.detail', $request->user_id)->with('message-error', 'Pembayaran belum bisa dilakukan tanggal lahir Anda belum lengkap, silahkan hubungi Customer Service untuk melengkapi data Anda. !'); 
        }

        $user->durasi_pembayaran    = $request->durasi_pembayaran;
        $user->first_durasi_pembayaran_date = date('Y-m-d');
        $user->save();

        $deposit                = new \Kodami\Models\Mysql\Deposit();
        $deposit->no_invoice    = no_invoice(); 
        $deposit->status        = 3; 
        $deposit->type          = 5; // Simpanan Wajib
        $deposit->user_id       = $request->user_id;
        $deposit->nominal       = $request->durasi_pembayaran * remove_number_format($request->nominal);
        $deposit->proses_user_id = \Auth::user()->id;
        $deposit->save();

        # cek simpanan pokok
        $cek = Deposit::where('status',3)->where('user_id', $request->user_id)->where('type', 3)->count();
        if($cek > 0)
        {
            $no_anggota = generate_no_anggota($request->user_id);

            if($no_anggota['status'] == 'success')
            {
                # set no anggota
                Users::where('id', $request->user_id)->update(['no_anggota', $no_anggota['data']]);
            }
        }

        return redirect()->route('kasir.anggota.detail', $request->user_id)->with('message-success', 'Topup Simpanan Wajib berhasil !');
    }
}
