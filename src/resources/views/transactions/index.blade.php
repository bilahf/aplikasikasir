@section('title', 'Riwayat Transaksi')
@section('page-title', 'Riwayat Transaksi')
@section('page-subtitle', 'Lihat semua transaksi penjualan yang telah dicatat.')

@extends('layouts.app')

@section('content')

<div class="card overflow-hidden">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 px-6 py-4 border-b border-soft-border bg-gradient-to-r from-primary-50/70 to-secondary-50/40">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-100 to-secondary-100 flex items-center justify-center">
                <span class="text-xl">🧾</span>
            </div>
            <div>
                <h2 class="font-bold text-soft-text">Daftar Transaksi</h2>
                <p class="text-xs text-soft-muted">Total {{ $transactions->total() }} transaksi tercatat</p>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto scrollbar-thin">
        @if($transactions->count() > 0)
            <table class="table-base">
                <thead>
                    <tr>
                        <th>ID / Tanggal</th>
                        <th>Kasir</th>
                        <th class="text-right">Total</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-2">
                                        <span class="badge-info text-xs font-mono">#TRX-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 mt-1 text-xs text-soft-muted">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $transaction->created_at->locale('id')->isoFormat('D MMM YYYY') }}
                                        <span class="text-soft-border">•</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $transaction->created_at->format('H:i') }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary-200 to-secondary-200 flex items-center justify-center font-bold text-xs text-white">
                                        {{ strtoupper(substr($transaction->user->name ?? '?', 0, 1)) }}
                                    </div>
                                    <span class="font-medium text-soft-text">{{ $transaction->user->name ?? 'Tidak Diketahui' }}</span>
                                </div>
                            </td>
                            <td class="text-right">
                                <p class="text-lg font-extrabold text-primary-600">
                                    Rp {{ number_format($transaction->total, 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-soft-muted">
                                    {{ $transaction->details->count() }} item
                                </p>
                            </td>
                            <td class="text-right">
                                <a href="{{ route('transactions.show', $transaction->id) }}" class="btn-outline !py-2 !px-3.5 text-sm inline-flex">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Lihat Struk
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <!-- Empty State -->
            <div class="p-14 text-center">
                <div class="w-24 h-24 mx-auto mb-5 rounded-full bg-gradient-to-br from-primary-50 to-secondary-50 flex items-center justify-center border border-dashed border-soft-border">
                    <span class="text-5xl">🧾</span>
                </div>
                <h3 class="text-lg font-semibold text-soft-text mb-2">Belum Ada Transaksi</h3>
                <p class="text-sm text-soft-muted mb-6 max-w-sm mx-auto">
                    Riwayat transaksi Anda akan ditampilkan di sini setelah melakukan penjualan pertama di halaman Kasir.
                </p>
                <a href="{{ route('cashier.index') }}" class="btn-primary">
                    <span class="mr-2">🛒</span>
                    Mulai Transaksi Pertama
                </a>
            </div>
        @endif
    </div>

    @if($transactions->count() > 0)
        <div class="px-5 py-4 border-t border-soft-border/60">
            {{ $transactions->links() }}
        </div>
    @endif
</div>

@endsection
