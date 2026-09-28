@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk')
@section('page-subtitle', 'Isi detail produk baru yang akan ditambahkan.')

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
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-100 to-secondary-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-bold text-soft-text">Form Tambah Produk</h2>
                <p class="text-sm text-soft-muted">Lengkapi semua bidang yang ditandai dengan <span class="text-red-500">*</span></p>
            </div>
        </div>

        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            @include('products._form')

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row items-center justify-end gap-3 mt-8 pt-6 border-t border-soft-border">
                <a href="{{ route('products.index') }}" class="btn-outline w-full sm:w-auto">
                    Batal
                </a>
                <button type="submit" class="btn-primary w-full sm:w-auto shadow-card">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
