<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\IncomingProduct;

class GoodsInController extends Controller
{
    public function AddStock(Request $request) {
        $request->all();
        $rules = [
            'qty' => 'required',
            'supplier_name' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors()
            ]);
        }

        DB::beginTransaction();

        try {
            $inProduct = new IncomingProduct();
            $inProduct->product_id = $request->product_id;
            $inProduct->qty = $request->qty;
            $inProduct->supplier_name = $request->supplier_name;
            $inProduct->save();

            $product = Product::find($request->product_id);
            $product->stok = $product->stok + $request->qty;
            $product->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'fail' => true,
                'error_message' => 'Terjadi Kesalahan saat Menambahkan Stok',
            ]);
        }

        return response()->json([
            'fail' => false
        ]);
    }
}
