<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CashierController extends Controller
{
    public function __constructor(){
        return $this->middleware('auth');
    }

    public function index(){
        $products = Product::where('stok', '>', 0)->get();
        return view('cashier', compact('products'));
    }
}
