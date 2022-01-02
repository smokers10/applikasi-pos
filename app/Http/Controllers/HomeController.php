<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\StokUnit;
use App\Models\Transaction;

class HomeController extends Controller
{
    public function __constructor(){
        return $this->middleware('auth');
    }

    public function index() {
        $product_count = Product::count();
        $total_selling = Product::sum('selling_points');
        $transaction_count = Transaction::count();
        $populars = Product::orderBy('selling_points', 'desc')->limit(10)->get();
        $insufficientStocks = Product::where('stok', '<', 10)->limit(10)->get();

        $data = [
            'product_count' => $product_count,
            'total_selling' => $total_selling,
            'transaction_count' => $transaction_count,
        ];

        return view('home', compact('data', 'insufficientStocks', 'populars'));
    }
}
