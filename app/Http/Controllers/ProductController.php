<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Category;
use App\Models\StokUnit;

class ProductController extends Controller
{
    public function __constructor(){
        return $this->middleware('auth');
    }

    public function index(){
        $products = Product::all();
        return view('product/index', compact('products'));
    }
    
    public function form(){
        $stock_units = StokUnit::all();
        $categories = Category::all();
        return view('product/form', compact('stock_units', 'categories'));
    }
    
    public function form_edit($id){
        $stock_units = StokUnit::all();
        $categories = Category::all();
        $product = Product::find($id);
        return view('product/form-edit', compact('stock_units', 'categories', 'product'));
    }

    public function update(Request $request) {
        $rules = [
            'name' => 'required',
            'code' => 'required|min:8|max:20',
            'selling_price' => 'required',
            'purchase_price' => 'required',
            'stok' => 'required',
            'stok_unit_id' => 'required',
            'category_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors()
            ]);
        }
   
        $data = Product::find($request->id);
        $data->name = $request->name;
        $data->code = $request->code;
        $data->stok = $request->stok;
        $data->purchase_price = $request->purchase_price;
        $data->stok_unit_id = $request->stok_unit_id;
        $data->category_id = $request->category_id;
        $data->selling_points = $request->selling_points;
        $data->selling_price = $request->selling_price;
        $data->save();

        return response()->json([
            'fail' => false
        ]);
    }

    public function create(Request $request) {
        $rules = [
            'name' => 'required',
            'code' => 'required|min:8|max:20',
            'selling_price' => 'required',
            'purchase_price' => 'required',
            'stok' => 'required',
            'stok_unit_id' => 'required',
            'category_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors()
            ]);
        }
   
        $data = new Product();
        $data->name = $request->name;
        $data->code = $request->code;
        $data->stok = $request->stok;
        $data->purchase_price = $request->purchase_price;
        $data->selling_price = $request->selling_price;
        $data->stok_unit_id = $request->stok_unit_id;
        $data->category_id = $request->category_id;
        $data->selling_points = $request->selling_points;
        $data->save();

        return response()->json([
            'fail' => false
        ]);
    }

    public function delete(Request $request) {
        $data = Product::find($request->id);
        $data->delete();
        return response()->json([
            'fail' => false
        ]);
    }
}
