<?php
namespace App\Http\Controllers;

use App\ModelUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class RegisterController extends Controller
{
    /**
     * [index description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function index()
    {
        return view('register.index');
    }


    public function registerPost(Request $request)
    {
    	$this->validate($request,[
    		'nik' 				=> 'required|unique:users',
    		'tempat_lahir'		=> 'required',
    		'tanggal_lahir'		=> 'required',
    		'jenis_kelamin'		=> 'required',
    		'alamat'			=> 'required',
    		'telepon'			=> 'required',
            'foto'              => 'required|mimes:jpg,jpeg,bmp,png:size:5000',
    		'foto_ktp'			=> 'required|mimes:jpg,jpeg,bmp,png:size:5000',
    		'name'				=> 'required',
    		'email'				=> 'required|email|unique:users',
    		'password'			=> 'required',
    		'confirmation'		=> 'required|same:password',
    	]);

    	$no_anggota = date('y').date('m').date('d'). (ModelUser::all()->count() + 1);

        $foto = $request->foto->store('foto');
        $foto_ktp = $request->foto_ktp->store('foto_ktp');

    	$data = new ModelUser();
        $data->foto                 = $foto;
        $data->foto_ktp             = $foto_ktp;
    	$data->nik 					= $request->nik;
    	$data->tempat_lahir 		= $request->tempat_lahir;
    	$data->tanggal_lahir 		= $request->tanggal_lahir;
    	$data->jenis_kelamin 		= $request->jenis_kelamin;
    	$data->alamat				= $request->alamat;
    	$data->telepon 				= $request->telepon;
    	$data->no_anggota 			= $no_anggota;
    	$data->name 				= $request->name;
    	$data->email 				= $request->email;
    	$data->password 			= bcrypt($request->password); 
    	$data->save();


    	return redirect('register')->with('alert-success', 'Berhasil melakukan registrasi');
    }
}