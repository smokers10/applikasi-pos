<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginCashierController extends Controller
{
    public function LoginPage() {
        return view('auth/login-cashier');
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required', 'min:6'],
        ]);
    }
}
