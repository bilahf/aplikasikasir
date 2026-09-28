@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')
@section('page-subtitle', 'Perbarui detail produk yang sudah ada.')

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

    <!-- Form Card -->
    <div class="card p-6 lg:p-8">
        <div class="flex items-center gap-4 mb-6 pb-6 border-b border-soft-border">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-secondary-100 to-primary-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-bold text-soft-text">Edit: {{ $product->name }}</h2>
                <p class="text-sm text-soft-muted">Perbarui informasi produk di bawah ini</p>
            </div>
        </div>

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('products._form', ['product' => $product])

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row items-center justify-end gap-3 mt-8 pt-6 border-t border-soft-border">
                <a href="{{ route('products.index') }}" class="btn-outline w-full sm:w-auto">
                    Batal
                </a>
                <button type="submit" class="btn-secondary w-full sm:w-auto shadow-card">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    Perbarui Produk
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
