@section('title', $product->name)
@section('page-title', 'Detail Produk')
@section('page-subtitle', 'Informasi lengkap produk.')

@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">
    <!-- Back Button -->
    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 mb-6 text-sm text-soft-muted hover:text-primary-600 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali ke Daftar Produk
    </a>

    <!-- Detail Card -->
    <div class="card overflow-hidden">
        <!-- Product Header -->
        <div class="bg-gradient-to-r from-primary-50 via-white to-secondary-50 p-6 lg:p-8 border-b border-soft-border">
            <div class="flex flex-col sm:flex-row sm:items-start gap-5">
                <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-primary-200 to-secondary-200 flex items-center justify-center flex-shrink-0 shadow-card">
                    <span class="text-5xl">📦</span>
                </div>
                <div class="flex-1">
                    <div class="flex flex-wrap items-center gap-3 mb-3">
                        <h2 class="text-2xl font-bold text-soft-text">{{ $product->name }}</h2>
                        @if($product->is_active)
                            <span class="badge-success">Aktif</span>
                        @else
                            <span class="badge-danger">Tidak Aktif</span>
                        @endif
                    </div>
                    <span class="badge-info inline-flex items-center">
                        <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        {{ $product->category->name ?? 'Kategori Tidak Ditemukan' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="p-6 lg:p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Price Card -->
                <div class="p-5 rounded-2xl bg-primary-50/70 border border-primary-100">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-xl bg-primary-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-primary-700">Harga Jual</span>
                    </div>
                    <p class="text-3xl font-bold text-soft-text">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                </div>

                <!-- Stock Card -->
                <div class="p-5 rounded-2xl bg-secondary-50/70 border border-secondary-100">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-xl bg-secondary-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-secondary-700">Stok Tersedia</span>
                    </div>
                    <p class="text-3xl font-bold text-soft-text flex items-center gap-3">
                        {{ $product->stock }}
                        @if($product->stock <= 0)
                            <span class="text-base font-medium badge-danger">Stok Habis</span>
                        @elseif($product->stock <= 5)
                            <span class="text-base font-medium badge-warning">Stok Menipis</span>
                        @else
                            <span class="text-base font-medium badge-success">Stok Aman</span>
                        @endif
                    </p>
                </div>
            </div>

            <!-- Description -->
            @if($product->description)
                <div class="mb-6">
                    <h3 class="text-sm font-semibold text-soft-muted uppercase tracking-wider mb-3">Deskripsi</h3>
                    <div class="p-5 rounded-2xl bg-soft-bg border border-soft-border">
                        <p class="text-soft-text whitespace-pre-wrap leading-relaxed">{{ $product->description }}</p>
                    </div>
                </div>
            @endif

            <!-- Timestamps -->
            <div class="flex flex-wrap gap-6 text-xs text-soft-muted pt-4 border-t border-soft-border">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Dibuat: {{ $product->created_at->locale('id')->isoFormat('D MMM YYYY HH:mm') }}
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Diperbarui: {{ $product->updated_at->locale('id')->isoFormat('D MMM YYYY HH:mm') }}
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row items-center justify-end gap-3 px-6 lg:px-8 py-5 border-t border-soft-border bg-soft-bg/50">
            <a href="{{ route('products.edit', $product->id) }}" class="btn-secondary w-full sm:w-auto">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit Produk
            </a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');"
                  class="w-full sm:w-auto">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger w-full sm:w-auto">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Hapus Produk
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
