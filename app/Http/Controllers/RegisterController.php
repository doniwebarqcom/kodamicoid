<?php
namespace App\Http\Controllers;

use App\ModelUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Mail\RegisterMail;
use Mail;
use Kodami\Models\Mysql\Users;

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

    /**
     * [registerPost description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function registerPost(Request $request)
    {
    	$this->validate($request,[
    		//'nik' 				=> 'required|unique:users',
    		'telepon'			=> 'required',
            'name'				=> 'required',
    		'email'				=> 'required|email|unique:users',
    		'password'			=> 'required',
    		'confirmation'		=> 'required|same:password',
    	]);

    	$no_anggota = date('y').date('m').date('d'). (ModelUser::all()->count() + 1);
    
    	$data = new ModelUser();
    	//$data->nik 					= $request->nik;
    	$data->telepon 				= $request->telepon;
    	$data->no_anggota 			= $no_anggota;
    	$data->name 				= strtoupper($request->name);
    	$data->email 				= $request->email;
    	$data->password 			= bcrypt($request->password); 
        $data->access_id            = 2; // User Sebagai Anggota
        $data->status               = 1; // menunggu pembayaran
        $data->status_login         = 1;
        $data->status_anggota       = 0;
    	$data->save();
        $data->password = $request->password;

        $params['user'] = $data;
        
        \Mail::send('email.register.success', $params,
                function($message) use($data) {
                    $message->from('noreply.kodami@gmail.com', 'Kodami Pocket System');
                    $message->to($data->email);
                    $message->subject('Registrasi - Kodami Pocket System');
                }
            );

    	return redirect('register/success')->with('success-register', 'Berhasil melakukan registrasi');
    }

    /**
     * [success description]
     * @return [type] [description]
     */
    public function success()
    {
        $session = session('success-register'); 
        
        if(isset($session))
            return view('success');
        else
            return redirect('home');
    }

    /**
     * [v2 description]
     * @return [type] [description]
     */
    public function v2()
    {
        return view('register.index');
    }
}