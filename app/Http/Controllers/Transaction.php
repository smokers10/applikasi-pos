<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction as TransactionModel;
use App\Models\TransactionItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Transaction extends Controller
{
    public function __constructor(){
        return $this->middleware('auth');
    }

    public function create(Request $request) {
        $reqJSON = $request->all();

        $rules = [
            'subtotal' => 'required',
            'total' => 'required',
            'payment' => 'required',
            'return' => 'required',
            'payment_method' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors()
            ]);
        }

        // generate no invoice
        $latestTransac = TransactionModel::latest()->first();
        $currentDate = date("Ymd");
        $randomNumber = rand(1000, 10000);
        $idOfLatestTransac = 0;
        
        if ($idOfLatestTransac == null) {
            $idOfLatestTransac = rand(1, 10000); 
        }else{
            $idOfLatestTransac = $latestTransac->id;
        }
        $inv_no = $currentDate.$randomNumber.$idOfLatestTransac;

        // ambil user id
        $user_id = Auth::user()->id;

        DB::beginTransaction();

        try {
            // simpan ke DB
            $transactionID = TransactionModel::insertGetId([
                "buyer_name" => $reqJSON["buyer_name"],
                "buyer_address" => $reqJSON["buyer_address"],
                "buyer_contact" => $reqJSON["buyer_contact"],
                "subtotal" => $reqJSON["subtotal"],
                "total" => $reqJSON["total"],
                "payment" => $reqJSON["payment"],
                "return" => $reqJSON["return"],
                "no_invoice" => $inv_no,
                "payment_method" => $reqJSON["payment_method"],
                "user_id" => $user_id,
            ]);
    
            // simpan item transaksi
            for ($i=0; $i < count($reqJSON["items"]); $i++) { 
                $item = $reqJSON["items"][$i];
                $transacItem = new TransactionItem();
                $transacItem->product_id = $item["item_id"];
                $transacItem->quantity = $item["qty"];
                $transacItem->transaction_id = $transactionID;
                $transacItem->save();
                
                // check & update stok, update selling points 
                $product = Product::find($item["item_id"]);
                $taken = $product->stok - $item["qty"];
                if($taken < 0) {
                    DB::rollback();
                    return response()->json([
                        'fail' => true,
                        'error_message' => 'Stok Produk Tidak Memadai',
                    ]);
                }
                $product->stok = $product->stok - $item["qty"];
                $product->selling_points = $product->selling_points + $item["qty"];
                $product->save();
            }        
            
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'fail' => true,
                'error_message' => 'terjadi kesalahan saat melakukan transaksi',
            ]);
        }

        return response()->json([
            'fail' => false
        ]);
    }
}
