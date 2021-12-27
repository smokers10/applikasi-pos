<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\StokUnit;

class StokUnitController extends Controller
{
    public function __constructor(){
        return $this->middleware('auth');
    }

    public function index(){
        $stok_units = StokUnit::all();
        return view('product/stok-unit', compact('stok_units'));
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
   
        $data = StokUnit::find($request->id);
        $data->name = $request->name;
        $data->save();

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
   
        $data = new StokUnit();
        $data->name = $request->name;
        $data->save();

        return response()->json([
            'fail' => false
        ]);
    }

    public function delete(Request $request) {
        $data = StokUnit::find($request->id);
        $data->delete();
        return response()->json([
            'fail' => false
        ]);
    }
}
