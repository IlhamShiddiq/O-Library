<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request){
        $validateData = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/selecting-user');
        }

        return redirect('/login')->with('status', 'Maaf, akun '.$request->username.' tidak dikenali, atau mungkin anda salah memasukkan data');
    }
}
