<?php

namespace App\Http\Controllers\Anggota;

use Illuminate\Http\Request;
use App\Http\Controllers\ControllerLogin;

use Kodami\Models\Mysql\RekeningBank;
use Kodami\Models\Mysql\Bank;
use Kodami\Models\Mysql\RekeningBankUser;
use Kodami\Models\Mysql\Deposit;

use Auth;

class BayarController extends ControllerLogin
{
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function step1()
    {
        $data = [];
        $data['rekening_bank']          = RekeningBank::all();
        $data['rekening_bank_user']     = RekeningBankUser::where('user_id', Auth::user()->id)->get();
        $data['bank']                   = Bank::all();  
        $data['total_pembayaran']       = '120'. rand(100, 999); 
        $data['invoice_date']           = date('d F Y');
        $data['due_date']               = date('d F Y', strtotime("+3 days"));
        $data['no_invoice']             = (Deposit::count()+1). Auth::user()->id.date('d').date('m').date('y');

    	return view('anggota.bayar.bayar')->with($data);
    }

    /**
     * [submit description]
     * @param  Request $reques [description]
     * @return [type]          [description]
     */
    public function submit(Request $request)
    {   
        $data = new Deposit;
        $data->no_invoice   = $request->no_invoice;
        $data->user_id      = Auth::user()->id;
        $data->status       = 1; // menunggu konfirmasi pembayaran
        $data->type         = 1; // pembayaran awal sebagai anggota
        $data->nominal      = $request->total_pembayaran;
        $data->rekening_bank_id = $request->rekening_bank_id;
        $data->rekening_bank_user_id = $request->rekening_bank_user_id;
        $data->due_date     = $request->due_date;
        $data->save();

        return redirect()->route('anggota.index')->with('message-success', 'Pembayaran anda berhasil dilakukan, silahkan melakukan pembayaran');
    }
}