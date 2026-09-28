@section('title', 'Edit Kategori: ' . $category->name)
@section('page-title', 'Edit Kategori')
@section('page-subtitle', 'Ubah nama kategori yang sudah ada.')

@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto">

    <!-- Back -->
    <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 mb-6 text-sm text-soft-muted hover:text-primary-600 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali ke Daftar Kategori
    </a>

    <!-- Form Card -->
    <div class="card p-6 lg:p-8 overflow-hidden">
        <!-- Decorative gradient top -->
        <div class="absolute inset-x-0 top-0 h-1.5 bg-gradient-to-r from-primary-300 via-secondary-300 to-primary-300"></div>

        <div class="relative flex items-center gap-4 mb-7 pb-6 border-b border-soft-border">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-100 to-secondary-100 flex items-center justify-center shadow-soft">
                <span class="text-2xl">✏️</span>
            </div>
            <div>
                <h2 class="text-xl font-bold text-soft-text">Ubah Kategori</h2>
                <p class="text-sm text-soft-muted">
                    Saat ini sedang mengedit kategori:
                    <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-primary-100 text-primary-700 font-semibold ml-1">
                        {{ $category->name }}
                    </span>
                </p>
            </div>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-7">
            <div class="p-4 rounded-xl bg-primary-50/70 border border-primary-100">
                <p class="text-xs font-medium text-primary-700 uppercase tracking-wider mb-1">ID Kategori</p>
                <p class="text-lg font-bold text-soft-text font-mono">#{{ str_pad($category->id, 4, '0', STR_PAD_LEFT) }}</p>
            </div>
            <div class="p-4 rounded-xl bg-secondary-50/70 border border-secondary-100">
                <p class="text-xs font-medium text-secondary-700 uppercase tracking-wider mb-1">Produk Terkait</p>
                <p class="text-lg font-bold text-soft-text">{{ $category->products_count }} item</p>
            </div>
            <div class="p-4 rounded-xl bg-soft-bg border border-soft-border">
                <p class="text-xs font-medium text-soft-muted uppercase tracking-wider mb-1">Dibuat Tanggal</p>
                <p class="text-sm font-semibold text-soft-text">
                    {{ $category->created_at->locale('id')->isoFormat('D MMM YYYY') }}
                </p>
            </div>
        </div>

        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-2">
                <label for="name" class="input-label">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-soft-muted">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        value="{{ old('name', $category->name) }}"
                        placeholder="Masukkan nama kategori baru"
                        maxlength="100"
                        required
                        autofocus
                        class="input-field pl-11 @error('name') border-red-400 focus:ring-red-300 focus:border-red-400 @enderror"
                    >
                </div>
                @error('name')
                    <p class="input-error-text flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
                <p class="mt-2 text-xs text-soft-muted flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    Perubahan nama kategori akan berdampak ke SELURUH produk yang menggunakan kategori ini.
                </p>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-end gap-3 mt-8 pt-6 border-t border-soft-border">
                <a href="{{ route('categories.index') }}" class="btn-outline w-full sm:w-auto">
                    Batal
                </a>
                <button type="submit" class="btn-primary w-full sm:w-auto shadow-card">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    Perbarui Kategori
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
