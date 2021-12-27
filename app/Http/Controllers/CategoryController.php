<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __constructor(){
        return $this->middleware('auth');
    }

    public function index(){
        $categories = Category::all();
        return view('product/category', compact('categories'));
    }

    public function update(Request $request) {
        $rules = [
            'name' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors()
            ]);
        }
   
        $cat = Category::find($request->id);
        $cat->name = $request->name;
        $cat->save();

        return response()->json([
            'fail' => false
        ]);
    }

    public function create(Request $request) {
        $rules = [
            'name' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors()
            ]);
        }
   
        $cat = new Category();
        $cat->name = $request->name;
        $cat->save();

        return response()->json([
            'fail' => false
        ]);
    }

    public function delete(Request $request) {
        $cat = Category::find($request->id);
        $cat->delete();
        return response()->json([
            'fail' => false
        ]);
    }
}
