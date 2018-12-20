<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kodami\Models\Mysql\Users; 
use Kodami\Models\Mysql\UserDropshiper; 
use Kodami\Models\Mysql\UserDropshiperHistoryKuota; 

class KemitraanController extends Controller
{	
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {
    	$params['dropshiper'] = Users::where('access_id', 7)->orderBy('id', 'DESC')->paginate(50);

    	return view('admin.kemitraan.index')->with($params);
    }

    /**
     * Add Kuota Dropshiper
     * @param [type] $id [description]
     */
    public function addKuota($id)
    {
        $user = UserDropshiper::where('user_id', $id)->first();
        if(!$user)
        {
            $user                           = new UserDropshiper();
            $user->user_id                  = $id;
            $user->saldo_terpakai           = 0;
            $user->total_saldo_terpakai     = 0;
        }

        if(empty($_GET['kuota']))
        {
            return redirect()->route('admin.kemitraan.index')->with('message-error', 'Nominal harus diisi !');
        }

        // history
        $history                    = new UserDropshiperHistoryKuota();
        $history->user_id           = $id;
        $history->user_proses_id    = \Auth::user()->id;
        $history->nominal           = $_GET['kuota'];
        $history->type              = 1; // topup by admin
        $history->save();

        $user->saldo        = $_GET['kuota'];
        $user->saldo_awal   = $_GET['kuota'];
        $user->save();

        return redirect()->route('admin.kemitraan.index')->with('message-success', 'Kuota berhasil di tambahkan !');
    }
}
