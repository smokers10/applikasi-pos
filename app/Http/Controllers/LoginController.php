<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // login Page
    public function login() {
        return view('auth/login');
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required', 'min:6'],
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/home');
        }

        return back()->with('login-error', 'Login gagal check email atau password');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
    }
}
