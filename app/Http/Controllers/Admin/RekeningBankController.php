<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\ControllerLogin;
use Kodami\Models\Mysql\RekeningBank; 
use Kodami\Models\Mysql\Bank;

class RekeningBankController extends ControllerLogin
{
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {        
        $data = RekeningBank::all();

    	return view('admin.rekening-bank.index', compact('data'));
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create()
    {
        $bank = Bank::all();

        return view('admin.rekening-bank.create', compact('bank'));
    }

    /**
     * [edit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id)
    {
        $bank = Bank::all();

        $data = RekeningBank::where('id', $id)->get();

        return view('admin.rekening-bank.edit', compact('data', 'bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data =  RekeningBank::where('id', $id)->first();
        $data->nama_akun            = $request->nama_akun;
        $data->no_rekening          = $request->no_rekening;
        $data->bank_id              = $request->bank_id;
        $data->cabang               = $request->cabang;
        $data->save();

        return redirect()->route('rekening-bank.index')->with('message-success', 'Data berhasil disimpan'); 
    }
    /**
     * [desctroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id)
    {
        $data = RekeningBank::where('id', $id)->first();
        $data->delete();

        return redirect()->route('rekening-bank.index')->with('message-sucess', 'Data berhasi di hapus');
    }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
        $data = new RekeningBank();
        $data->nama_akun            = $request->nama_akun;
        $data->no_rekening          = $request->no_rekening;
        $data->bank_id              = $request->bank_id;
        $data->cabang               = $request->cabang;
        $data->save();

        return redirect()->route('rekening-bank.index')->with('messages-success', 'Data berhasil disimpan');
   }
}