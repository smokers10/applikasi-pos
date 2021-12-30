<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "buyer_name",
        "buyer_address",
        "buyer_contact",
        "payment_total",
        "payment",
        "return",
        "no_invoice",
    ];
}
