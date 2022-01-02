<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\StokUnit;
use App\Models\Transaction;

class LaporanController extends Controller
{
    public function index(Request $request) {
        $transactions = null;

        if ($request->end_date != "" || $request->no_invoice || $request->no_invoice) {
            $transactions = Transaction::whereDate('created_at', '>=', $request->start_date)
            ->whereDate('created_at', '<=', $request->end_date)
            ->get();
        } else {
            $transactions = Transaction::latest()->get();
        }

        return view('laporan.berkala', compact('transactions'));
    }

    public function invoice($id) {
        $transaction = Transaction::find($id);
        return view('laporan.invoice', compact('transaction'));
    }
}
