<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;

class StokUnit extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name'];

    public function Product(){
        return $this->hasMany(Product::class);
    }
}
