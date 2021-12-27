<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function __constructor(){
        return $this->middleware('auth');
    }

    public function index(){
        return view('cashier');
    }
}
