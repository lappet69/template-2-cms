<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->to(route('administrator.home'));
        }else{
            return view('back.login');
        }
    }

    public function actionlogin(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::Attempt($data)) {
            return redirect()->to(route('administrator.home'));
        }else{
            Session::flash('error', 'Email atau Password Salah');
            return redirect()->to(route('login'));
        }
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
