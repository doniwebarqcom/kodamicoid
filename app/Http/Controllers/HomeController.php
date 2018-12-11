<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodami\Models\Mysql\ContactUs;
use Kodami\Models\Mysql\Users;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * [postContactUs description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postContactUs(Request $request)
    {
        $data           = new ContactUs();
        $data->nama     = $request->nama;
        $data->email    = $request->email;
        $data->telepon  = $request->telepon;
        $data->message  = $request->message;
        $data->save();

        return redirect('/')->with('messages', 'Pertanyaan dan Kritik anda akan kami proses dengan segera.');
    }

    /**
     * Daftar Anggota Baru
     */
    public function daftar()
    {
        return view('auth.daftar');
    }

    /**
     * Request Store
     */
    public function daftarStore(Request $request)
    {
        $this->validate($request,[
            'name'              => 'required',
            'telepon'           => 'required|unique:users',
            'email'             => 'required|email|unique:users',
        ]);

        $password = generateRandomString(6);
        $no_anggota = date('y').date('m').date('d'). (Users::all()->count() + 1);

        $data                   =  new Users();
        $data->nik              = $request->nik; 
        $data->no_anggota       = $no_anggota;
        $data->name             = $request->name; 
        $data->jenis_kelamin    = $request->jenis_kelamin; 
        $data->email            = $request->email;
        $data->telepon          = $request->telepon;
        $data->agama            = $request->agama;
        $data->tempat_lahir     = $request->tempat_lahir;
        $data->tanggal_lahir    = $request->tanggal_lahir;
        $data->password         = bcrypt($password);
        $data->aktivasi_code    = $password;
        $data->domisili_provinsi_id     = $request->domisili_provinsi_id;
        $data->domisili_kabupaten_id    = $request->domisili_kabupaten_id;
        $data->domisili_kecamatan_id    = $request->domisili_kecamatan_id;
        $data->domisili_kelurahan_id    = $request->domisili_kelurahan_id;
        $data->domisili_alamat          = $request->domisili_alamat;
        $data->durasi_pembayaran        = $request->durasi_pembayaran;
        $data->save();

        $params['user'] = $data;
        
        \Mail::send('email.register.success', $params,
            function($message) use($data) {
                $message->from('noreply.kodami@gmail.com', 'Kodami Pocket System');
                $message->to($data->email);
                $message->subject('Registrasi - Kodami Pocket System');
            }
        );

        // send notifikasi ke admin ketika ada registrasi baru
        \Mail::send('email.register.success', $params,
            function($message) use($data) {
                $message->from('noreply.kodami@gmail.com', 'Kodami Pocket System');
                $message->to('noreply.kodami@gmail.com');
                $message->subject('Pendaftaran Baru Anggota #'. $data->name .' - Kodami Pocket System');
            }
        );

        return redirect('register/success')->with('success-register', 'Berhasil melakukan registrasi');
    }

    /**
     * Aktivasi Link
     * @return redirect
     */
    public function aktivasi($no_pendaftaran)
    {
        $user = \Kodami\Models\Mysql\Users::where('no_pendaftaran', $no_pendaftaran)->first();

        if($user)
        {
            if($user->aktivasi_link == 1)
            {
                return view('auth.konfirmasi')->with(['data' => $user]);
                #return redirect()->route('login')->with('message-success', 'Anda sudah melakukan aktivasi silahkan login.');                
            }
            else
            {
                $user->aktivasi_link = 1;
                $user->save();
                
                return redirect()->route('login')->with('message-success', 'Aktivasi Anda sudah berhasil silahkan login.');                
            }
        }
        else
        {
            return redirect('/')->with('message-success', 'Maaf link aktivasi anda sudah tidak berlaku lagi.');
        }
    }
}
