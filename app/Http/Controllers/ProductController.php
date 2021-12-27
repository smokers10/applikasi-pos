<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __constructor(){
        return $this->middleware('auth');
    }

    public function index(){
        return view('product/index');
    }
}
