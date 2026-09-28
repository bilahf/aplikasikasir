@section('title', 'Kasir')
@section('page-title', 'Kasir')
@section('page-subtitle', 'Transaksi penjualan - pilih produk, masukkan ke keranjang, lalu checkout.')

@extends('layouts.app')

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Kiri: Daftar Produk -->
    <div class="lg:col-span-2 space-y-5">
        <div class="card overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-soft-border bg-gradient-to-r from-primary-50/70 to-transparent">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-primary-100 flex items-center justify-center">
                        <span class="text-lg">📦</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-soft-text">Daftar Produk</h3>
                        <p class="text-xs text-soft-muted">{{ $products->count() }} produk tersedia</p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
                        @foreach($products as $product)
                            <div class="group relative rounded-2xl border border-soft-border bg-white hover:border-primary-200 hover:shadow-card transition-all duration-200 overflow-hidden {{ $product->stock <= 0 ? 'opacity-60' : '' }}">
                                <div class="p-4">
                                    <div class="flex items-start justify-between gap-3 mb-3">
                                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-100 to-secondary-100 flex items-center justify-center flex-shrink-0">
                                            <span class="text-2xl">📦</span>
                                        </div>
                                        @if($product->stock <= 0)
                                            <span class="badge-danger text-xs">Habis</span>
                                        @elseif($product->stock <= 5)
                                            <span class="badge-warning text-xs">Stok {{ $product->stock }}</span>
                                        @else
                                            <span class="badge-success text-xs">Stok {{ $product->stock }}</span>
                                        @endif
                                    </div>
                                    <h4 class="font-semibold text-soft-text text-sm mb-1 line-clamp-2 min-h-[2.5rem]">
                                        {{ $product->name }}
                                    </h4>
                                    <p class="text-xs text-soft-muted mb-2">
                                        {{ $product->category->name ?? '-' }}
                                    </p>
                                    <div class="flex items-end justify-between gap-2 pt-2 border-t border-soft-border/60">
                                        <div>
                                            <p class="text-[10px] text-soft-muted uppercase tracking-wide">Harga</p>
                                            <p class="text-lg font-bold text-primary-600">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <form action="{{ route('cashier.add', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                    {{ $product->stock <= 0 ? 'disabled' : '' }}
                                                    class="btn-secondary !px-3 !py-2 text-sm disabled:opacity-40 disabled:cursor-not-allowed">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                                Tambah
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-10 text-center">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-secondary-50 flex items-center justify-center">
                            <svg class="w-10 h-10 text-secondary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-soft-text mb-2">Tidak Ada Produk Aktif</h3>
                        <p class="text-sm text-soft-muted">Belum ada produk yang aktif untuk dijual.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Kanan: Keranjang -->
    <div class="lg:col-span-1">
        <div class="card overflow-hidden lg:sticky lg:top-6">
            <div class="flex items-center justify-between px-6 py-4 border-b border-soft-border bg-gradient-to-r from-secondary-50/70 to-transparent">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-secondary-100 flex items-center justify-center">
                        <span class="text-lg">🛒</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-soft-text">Keranjang</h3>
                        <p class="text-xs text-soft-muted">
                            {{ $cart ? count($cart) : 0 }} jenis barang
                        </p>
                    </div>
                </div>
                @if($cart && count($cart) > 0)
                    <form action="{{ route('cashier.clear') }}" method="POST"
                          onsubmit="return confirm('Kosongkan seluruh keranjang?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-ghost !px-3 !py-1.5 text-xs text-red-600 hover:text-red-700 hover:bg-red-50">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Bersihkan
                        </button>
                    </form>
                @endif
            </div>

            <div class="flex flex-col max-h-[60vh] overflow-y-auto scrollbar-thin">
                @if($cart && count($cart) > 0)
                    <ul class="divide-y divide-soft-border">
                        @foreach($cart as $id => $details)
                            <li class="p-5 hover:bg-soft-bg/50 transition-colors">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-soft-text text-sm mb-0.5 truncate">
                                            {{ $details['name'] }}
                                        </p>
                                        <p class="text-xs text-soft-muted mb-2">
                                            Rp {{ number_format($details['price'], 0, ',', '.') }} × {{ $details['quantity'] }}
                                        </p>
                                        <p class="text-sm font-bold text-primary-600">
                                            Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-primary-100 text-primary-700 font-bold text-sm">
                                            {{ $details['quantity'] }}
                                        </span>
                                        <form action="{{ route('cashier.remove', $id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="p-2 rounded-lg text-soft-muted hover:text-red-600 hover:bg-red-50 transition-colors"
                                                    title="Kurangi satu">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="p-10 text-center">
                        <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-soft-bg flex items-center justify-center border border-dashed border-soft-border">
                            <span class="text-3xl">🛒</span>
                        </div>
                        <h4 class="font-semibold text-soft-text mb-1">Keranjang Kosong</h4>
                        <p class="text-xs text-soft-muted">Klik tombol Tambah pada produk untuk memasukkan ke keranjang.</p>
                    </div>
                @endif
            </div>

            <!-- Summary & Checkout -->
            <div class="border-t border-soft-border bg-soft-bg/50 px-6 py-5 space-y-5">
                <!-- Subtotal -->
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-soft-muted">Subtotal</span>
                        <span class="text-sm font-semibold text-soft-text">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="h-px bg-soft-border"></div>
                    <div class="flex items-center justify-between pt-1">
                        <span class="text-sm font-bold uppercase tracking-wider text-soft-muted">Total</span>
                        <span class="text-2xl font-extrabold text-primary-600">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <form action="{{ route('cashier.store') }}" method="POST">
                    @csrf
                    <button type="submit"
                            {{ !$cart || count($cart) <= 0 ? 'disabled' : '' }}
                            class="btn-success w-full justify-center shadow-card text-base py-3.5 disabled:opacity-40 disabled:cursor-not-allowed">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        BAYAR & CETAK STRUK
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection
