@section('title', 'Kategori')
@section('page-title', 'Kategori')
@section('page-subtitle', 'Kelola kategori untuk pengelompokan barang.')

@extends('layouts.app')

@section('content')

<!-- Header -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h2 class="text-xl font-bold text-soft-text hidden sm:block">Daftar Kategori</h2>
        <p class="text-sm text-soft-muted">Total {{ $categories->total() }} kategori terdaftar</p>
    </div>
    <a href="{{ route('categories.create') }}" class="btn-secondary">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        Tambah Kategori
    </a>
</div>

<!-- Table Card -->
<div class="card overflow-hidden">
    <div class="overflow-x-auto scrollbar-thin">
        @if($categories->count() > 0)
            <table class="table-base">
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <th class="text-center">Jumlah Produk</th>
                        <th>Terakhir Diperbarui</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-secondary-100 to-primary-100 flex items-center justify-center flex-shrink-0">
                                        <span class="text-lg">🏷️</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-soft-text">{{ $category->name }}</p>
                                        <p class="text-xs text-soft-muted font-mono">ID: #{{ str_pad($category->id, 4, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                @if($category->products_count > 0)
                                    <a href="{{ route('products.index') }}" class="badge-info hover:bg-primary-200 transition-colors inline-flex">
                                        {{ $category->products_count }} produk
                                    </a>
                                @else
                                    <span class="badge">
                                        {{ $category->products_count }} produk
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="flex items-center gap-1.5 text-sm text-soft-muted">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $category->updated_at->locale('id')->diffForHumans() }}
                                </div>
                                <p class="text-xs text-soft-muted mt-0.5 pl-5.5">
                                    {{ $category->updated_at->locale('id')->isoFormat('D MMM YYYY HH:mm') }}
                                </p>
                            </td>
                            <td>
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                       class="p-2 rounded-lg text-soft-muted hover:bg-secondary-50 hover:text-secondary-600 transition-colors"
                                       title="Edit kategori">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="p-2 rounded-lg text-soft-muted hover:bg-red-50 hover:text-red-600 transition-colors"
                                                title="Hapus kategori">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <!-- Empty State -->
            <div class="p-14 text-center">
                <div class="w-24 h-24 mx-auto mb-5 rounded-full bg-gradient-to-br from-secondary-50 to-primary-50 flex items-center justify-center border border-dashed border-soft-border">
                    <span class="text-5xl">🏷️</span>
                </div>
                <h3 class="text-lg font-semibold text-soft-text mb-2">Belum Ada Kategori</h3>
                <p class="text-sm text-soft-muted mb-6 max-w-sm mx-auto">
                    Tambahkan kategori terlebih dahulu agar Anda bisa mengelompokkan produk dan mengisi form Tambah Barang.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ route('categories.create') }}" class="btn-secondary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Tambah Kategori Pertama
                    </a>
                    <a href="{{ route('products.index') }}" class="btn-outline">
                        Lihat Daftar Produk
                    </a>
                </div>
            </div>
        @endif
    </div>

    @if($categories->count() > 0)
        <div class="px-5 py-4 border-t border-soft-border/60">
            {{ $categories->links() }}
        </div>
    @endif
</div>

<!-- Info Hapus Kategori -->
<div class="mt-6 p-5 rounded-2xl bg-primary-50/70 border border-primary-100 flex items-start gap-4">
    <div class="w-10 h-10 rounded-xl bg-primary-100 flex items-center justify-center flex-shrink-0">
        <svg class="w-5 h-5 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </div>
    <div>
        <h4 class="font-semibold text-primary-800 mb-1">Catatan Tentang Penghapusan Kategori</h4>
        <p class="text-sm text-primary-700/90 leading-relaxed">
            Kategori yang masih memiliki produk <strong>TIDAK DAPAT</strong> dihapus secara langsung. Pindahkan dahulu produk-produk tersebut ke kategori lain, barulah kategori dapat dihapus. Ini menjaga agar data produk selalu memiliki kategori yang valid.
        </p>
    </div>
</div>

@endsection
