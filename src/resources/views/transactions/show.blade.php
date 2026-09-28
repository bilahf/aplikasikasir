@section('title', 'Struk #TRX-' . str_pad($transaction->id, 5, '0', STR_PAD_LEFT))
@section('page-title', 'Struk Transaksi')
@section('page-subtitle', 'Detail struk transaksi penjualan.')

@extends('layouts.app')

@section('content')

<div class="max-w-lg mx-auto">

    <!-- Actions -->
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('transactions.index') }}" class="inline-flex items-center gap-2 text-sm text-soft-muted hover:text-primary-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Riwayat
        </a>
        <button onclick="window.print()" class="btn-outline !py-2 !px-3.5 text-sm">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Cetak Struk
        </button>
    </div>

    <!-- Receipt Card -->
    <div class="bg-white border border-soft-border shadow-card rounded-3xl overflow-hidden">

        <!-- Paper top notches -->
        <div class="relative bg-gradient-to-b from-primary-50 to-white py-8 border-b border-dashed border-soft-border">
            <!-- Holes -->
            <div class="absolute -left-2 top-1/2 -translate-y-1/2 w-4 h-4 rounded-full bg-soft-bg"></div>
            <div class="absolute -right-2 top-1/2 -translate-y-1/2 w-4 h-4 rounded-full bg-soft-bg"></div>

            <!-- Store Header -->
            <div class="text-center px-8">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br from-primary-200 to-secondary-200 mb-3 shadow-soft">
                    <span class="text-3xl">🏪</span>
                </div>
                <h1 class="text-2xl font-extrabold tracking-tight text-soft-text mb-1">KASIRKU</h1>
                <p class="text-xs text-soft-muted tracking-wide">APLIKASI KASIR SEDERHANA</p>
                <p class="mt-2 inline-block font-mono text-[11px] bg-soft-bg px-3 py-1 rounded-full text-soft-muted">
                    #TRX-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}
                </p>
            </div>
        </div>

        <!-- Meta -->
        <div class="px-8 py-5 space-y-2.5 text-sm border-b border-dashed border-soft-border bg-white">
            <div class="flex items-start justify-between gap-3">
                <span class="text-soft-muted flex items-center gap-1.5 min-w-[90px]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Tanggal
                </span>
                <span class="font-medium text-soft-text text-right">
                    {{ $transaction->created_at->locale('id')->isoFormat('D MMMM YYYY HH:mm') }}
                </span>
            </div>
            <div class="flex items-start justify-between gap-3">
                <span class="text-soft-muted flex items-center gap-1.5 min-w-[90px]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Kasir
                </span>
                <span class="font-medium text-soft-text text-right">
                    {{ $transaction->user->name ?? 'Tidak Diketahui' }}
                </span>
            </div>
        </div>

        <!-- Items Table -->
        <div class="px-8 py-6 border-b border-dashed border-soft-border">
            <!-- Header -->
            <div class="grid grid-cols-12 gap-2 pb-3 mb-3 border-b border-soft-border/60 text-xs uppercase tracking-wider font-bold text-soft-muted">
                <div class="col-span-6">Produk</div>
                <div class="col-span-2 text-center">Qty</div>
                <div class="col-span-4 text-right">Subtotal</div>
            </div>

            <!-- Rows -->
            <div class="space-y-3">
                @foreach($transaction->details as $detail)
                    <div class="grid grid-cols-12 gap-2 text-sm">
                        <div class="col-span-6">
                            <p class="font-medium text-soft-text leading-tight">{{ $detail->product->name ?? 'Produk Dihapus' }}</p>
                            <p class="text-[11px] text-soft-muted mt-0.5">
                                @ Rp {{ number_format($detail->product->price ?? $detail->subtotal / $detail->quantity, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="col-span-2 text-center font-semibold text-soft-text">
                            {{ $detail->quantity }}
                        </div>
                        <div class="col-span-4 text-right font-semibold text-soft-text">
                            Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Totals -->
        <div class="px-8 py-6 border-b border-dashed border-soft-border space-y-3">
            <div class="flex items-center justify-between gap-3 text-sm">
                <span class="text-soft-muted font-medium">Jumlah Item</span>
                <span class="font-semibold text-soft-text">
                    {{ $transaction->details->sum('quantity') }} barang
                </span>
            </div>
            <div class="flex items-center justify-between gap-3 pt-3 border-t border-soft-border">
                <span class="text-base font-bold uppercase tracking-wider text-soft-muted">TOTAL</span>
                <span class="text-2xl font-extrabold text-primary-600">
                    Rp {{ number_format($transaction->total, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <!-- Footer -->
        <div class="relative px-8 py-6 text-center bg-gradient-to-b from-white to-secondary-50/50">
            <!-- Holes -->
            <div class="absolute -left-2 top-1/2 -translate-y-1/2 w-4 h-4 rounded-full bg-soft-bg"></div>
            <div class="absolute -right-2 top-1/2 -translate-y-1/2 w-4 h-4 rounded-full bg-soft-bg"></div>

            <svg class="w-10 h-10 mx-auto text-secondary-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            <p class="font-semibold text-soft-text mb-1">Terima kasih atas kunjungan Anda!</p>
            <p class="text-xs text-soft-muted">Barang yang sudah dibeli tidak dapat ditukar atau dikembalikan.</p>
        </div>
    </div>

    <!-- Bottom quick actions (hidden when printing) -->
    <div class="flex flex-col sm:flex-row gap-3 mt-8 print:hidden">
        <a href="{{ route('transactions.index') }}" class="btn-outline w-full sm:flex-1 justify-center">
            ← Kembali ke Riwayat
        </a>
        <a href="{{ route('cashier.index') }}" class="btn-secondary w-full sm:flex-1 justify-center">
            🛒 Transaksi Baru
        </a>
    </div>

@endsection
