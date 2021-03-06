<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * [credentials description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    protected function credentials(Request $request)
    {
        if($request->get('email')){

            #cek user
            $no_anggota = str_replace('-', '', $request->get('email'));

            # cek login dengan no handphone
            $user = \Kodami\Models\Mysql\Users::where('telepon', $no_anggota)->first();
            if($user)
            {
                return ['telepon'=>$no_anggota,'password'=> $request->get('password'), 'status_login' => 1];
            }

            # cek login no anggota
            $user = \Kodami\Models\Mysql\Users::where('no_anggota', $no_anggota)->first();
            if($user)
            {
                return ['no_anggota'=>$no_anggota,'password'=> $request->get('password'), 'status_login' => 1];
            }

            return ['no_anggota'=>$no_anggota,'password'=> $request->get('password'), 'status_login' => 1];
        }

        return $request->only($this->username(), 'password');
    }
    

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
        // if user have role
        if (auth()->user()->access_id == 1)
        {
            return $this->redirectTo = '/admin';
        }
        elseif(auth()->user()->access_id == 2)
        {
            return $this->redirectTo = '/anggota';            
        }
        elseif(auth()->user()->access_id == 3)
        {
            return $this->redirectTo = '/kasir';
        }
        elseif(auth()->user()->access_id == 4)
        {
            return $this->redirectTo = '/cs';
        }
        elseif(auth()->user()->access_id == 5)
        {
            return $this->redirecTo = 'operator';
        }
        elseif(auth()->user()->access_id == 6)
        {
            return $this->redirectTo = 'admin-operator';
        }
        elseif(auth()->user()->access_id == 7)
        {
            return $this->redirectTo = '/dropshiper';
        }
        
        return $this->redirectTo = '/home';
    }
}
