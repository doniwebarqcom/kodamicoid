<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodami\Models\Mysql\RekeningBankUser;

class AjaxController extends Controller
{
    protected $respon;

    /**
     * [__construct description]
     */
    public function __construct()
    {
        /**
         * [$this->respon description]
         * @var [type]
         */
        $this->respon = ['message' => 'error', 'data' => []];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ;
    }

    /**
     * [postContactUs description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function addRekeningBank(Request $request)
    {

        if($request->ajax())
        {
            $data               = new RekeningBankUser();
            $data->nama_akun    = $request->nama_akun;
            $data->no_rekening  = $request->no_rekening;
            $data->bank_id      = $request->bank_id;
            $data->cabang       = $request->cabang;
            $data->user_id      = $request->user_id; 
            $data->save();

            $data->image = $data->bank->image;

            $this->respon = ['message' => 'success', 'data' => $data];

            return response()->json($this->respon);
        }else 
            return response()->json($this->respon);
    }

    /**
     * [deleteRekeningBankUser description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deleteRekeningBankUser($id)
    {
        $this->respon = ['message' => 'error', 'data' => []];

        if($request->ajax())
        {
            $data = RekeningBankUser::where('id', $id)->first();
            $data->delete();

            $this->respon = ['message' => 'success', 'data' => []];

            return response()->json($this->respon);

        }else 
            return response()->json($this->respon);
    }   
}
