<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodami\Models\Mysql\ContactUs;


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
                return redirect()->route('login')->with('message-success', 'Anda sudah melakukan aktivasi silahkan login.');                
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
