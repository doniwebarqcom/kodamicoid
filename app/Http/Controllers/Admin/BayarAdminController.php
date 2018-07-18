<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\ControllerLogin;
use Kodami\Models\Mysql\Deposit;
use App\ModelUser; 

class BayarAdminController extends ControllerLogin
{
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {        
    	return;
    }

    /**
     * [approve description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function approve($id)
    {  
        $deposit = Deposit::where('id', $id)->first();
        $deposit->status = 3;
        $deposit->save();   

        /** Rubah status angota jadi active */
        $user = ModelUser::where('id', $deposit->user_id)->first();
        $user->status = 2;
        $user->save();

        return redirect()->route('anggota.index')->with('message-success', "Proses Approval berhasil");
    }

    /**
     * [denied description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function denied($id)
    {   
        $deposit = Deposit::where('id', $id)->first();
        $deposit->status = 4;
        $deposit->save();

         /** Rubah status angota jadi reject */
        $user = ModelUser::where('id', $deposit->user_id)->first();
        $user->status = 3;
        $user->save();

        return redirect()->route('anggota.index')->with('message-success', "Proses Reject berhasil");
    }
}
