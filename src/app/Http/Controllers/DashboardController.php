<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $todaySales = Transaction::whereDate(
            'created_at',
            today()
        )->sum('total');

        $todayCount = Transaction::whereDate(
            'created_at',
            today()
        )->count();

        return view(
            'dashboard',
            compact(
                'todaySales',
                'todayCount'
            )
        );
    }
}