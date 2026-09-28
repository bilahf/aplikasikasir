<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class CashierController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)->get();

        $cart = session('cart', []);

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view(
            'cashier.index',
            compact('products', 'cart', 'total')
        );
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);

        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cashier.index');
    }

    public function remove($id)
    {
        $cart = session('cart', []);

        unset($cart[$id]);

        session()->put('cart', $cart);

        return redirect()->route('cashier.index');
    }

    public function clear()
    {
        session()->forget('cart');

        return redirect()->route('cashier.index');
    }

    public function store()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with(
                'error',
                'Keranjang masih kosong.'
            );
        }

        try {
            $transaction = DB::transaction(function () use ($cart) {

                $total = 0;

                foreach ($cart as $id => $item) {

                    $product = Product::findOrFail($id);

                    if ($product->stock < $item['quantity']) {
                        throw new \Exception(
                            "Stok {$product->name} tidak cukup."
                        );
                    }

                    $total +=
                        $item['price'] *
                        $item['quantity'];
                }

                $transaction = Transaction::create([
                    'total' => $total,
                    'user_id' => auth()->id(),
                ]);

                foreach ($cart as $id => $item) {

                    $transaction->details()->create([
                        'product_id' => $id,
                        'quantity' => $item['quantity'],
                        'subtotal' =>
                            $item['price'] *
                            $item['quantity'],
                    ]);

                    $product = Product::findOrFail($id);

                    $product->decrement(
                        'stock',
                        $item['quantity']
                    );
                }

                return $transaction;
            });

        } catch (\Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );
        }

        session()->forget('cart');

        return redirect()
            ->route(
                'transactions.show',
                $transaction->id
            )
            ->with(
                'success',
                'Transaksi berhasil disimpan.'
            );
    }
}