<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\StokUnit;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        "name", 
        "code",
        "stok",
        "selling_price",
        "purchase_price",
        "stok_unit_id",
        "category_id",
        "selling_points",
    ];

    public function stok_unit() {
        return $this->belongsTo(StokUnit::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
