<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Transaction extends Controller
{
    public function __constructor(){
        return $this->middleware('auth');
    }

}
