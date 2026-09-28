@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')
@section('page-subtitle', 'Buat kategori baru untuk mengelompokkan produk.')

@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto">

    <!-- Back -->
    <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 mb-6 text-sm text-soft-muted hover:text-secondary-600 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali ke Daftar Kategori
    </a>

    <!-- Form Card -->
    <div class="card p-6 lg:p-8 overflow-hidden">
        <!-- Decorative gradient top -->
        <div class="absolute inset-x-0 top-0 h-1.5 bg-gradient-to-r from-secondary-300 via-primary-300 to-secondary-300"></div>

        <div class="relative flex items-center gap-4 mb-7 pb-6 border-b border-soft-border">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-secondary-100 to-primary-100 flex items-center justify-center shadow-soft">
                <span class="text-2xl">🏷️</span>
            </div>
            <div>
                <h2 class="text-xl font-bold text-soft-text">Form Tambah Kategori</h2>
                <p class="text-sm text-soft-muted">Isi nama kategori baru di bawah ini. Nama kategori harus unik (tidak boleh sama).</p>
            </div>
        </div>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="mb-2">
                <label for="name" class="input-label">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-soft-muted">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        value="{{ old('name') }}"
                        placeholder="Contoh: Makanan, Minuman, Sembako, dll."
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Maksimal 100 karakter. Gunakan nama yang mudah dikenali.
                </p>
            </div>

            <!-- Contoh rekomendasi -->
            <div class="mt-7 mb-8 p-4 rounded-2xl bg-soft-bg border border-soft-border">
                <p class="text-xs font-semibold uppercase tracking-wider text-soft-muted mb-3 flex items-center gap-1.5">
                    <span>💡</span>
                    Rekomendasi Kategori
                </p>
                <div class="flex flex-wrap gap-2">
                    @php($recommendations = ['Makanan', 'Minuman', 'Sembako', 'Snack', 'Lainnya'])
                    @foreach($recommendations as $rec)
                        <button type="button"
                                onclick="document.getElementById('name').value = '{{ $rec }}'; document.getElementById('name').focus();"
                                class="px-3 py-1.5 rounded-lg bg-white border border-soft-border hover:border-secondary-300 hover:bg-secondary-50 text-sm text-soft-text hover:text-secondary-700 transition-colors">
                            {{ $rec }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-6 border-t border-soft-border">
                <a href="{{ route('categories.index') }}" class="btn-outline w-full sm:w-auto">
                    Batal
                </a>
                <button type="submit" class="btn-secondary w-full sm:w-auto shadow-card">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
