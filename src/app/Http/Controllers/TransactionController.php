<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')
            ->latest()
            ->paginate(10);

        return view(
            'transactions.index',
            compact('transactions')
        );
    }

    public function show($id)
    {
        $transaction = Transaction::with(
            'details.product'
        )->findOrFail($id);

        return view(
            'transactions.show',
            compact('transaction')
        );
    }
}