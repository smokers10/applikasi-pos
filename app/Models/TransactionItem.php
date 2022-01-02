<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Transaction;


class TransactionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_id",
        "quantity",
        "transaction_id"
    ];

    public function transaction() {
        return $this->belongsTo(Transaction::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
