@section('title', 'Produk')
@section('page-title', 'Produk')
@section('page-subtitle', 'Kelola produk yang tersedia di toko.')

@extends('layouts.app')

@section('content')

<!-- Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h2 class="text-xl font-bold text-soft-text hidden sm:block">Daftar Semua Produk</h2>
        <p class="text-sm text-soft-muted">Total {{ $products->total() }} produk terdaftar</p>
    </div>
    <a href="{{ route('products.create') }}" class="btn-primary">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        Tambah Produk
    </a>
</div>

<!-- Table Card -->
<div class="card overflow-hidden">
    <div class="overflow-x-auto scrollbar-thin">
        @if($products->count() > 0)
            <table class="table-base">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-100 to-secondary-100 flex items-center justify-center flex-shrink-0">
                                        <span class="text-lg">📦</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-soft-text">{{ $product->name }}</p>
                                        @if($product->description)
                                            <p class="text-xs text-soft-muted truncate max-w-xs">{{ Str::limit($product->description, 50) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge-info">
                                    {{ $product->category->name ?? '-' }}
                                </span>
                            </td>
                            <td class="font-semibold text-soft-text">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td>
                                <span class="inline-flex items-center gap-1.5">
                                    @if($product->stock <= 0)
                                        <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                        <span class="text-red-600 font-semibold">{{ $product->stock }}</span>
                                    @elseif($product->stock <= 5)
                                        <span class="w-2 h-2 rounded-full bg-secondary-500"></span>
                                        <span class="text-secondary-700 font-semibold">{{ $product->stock }}</span>
                                    @else
                                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                        <span class="font-semibold text-soft-text">{{ $product->stock }}</span>
                                    @endif
                                </span>
                            </td>
                            <td>
                                @if($product->is_active)
                                    <span class="badge-success">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="badge-danger">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5"></span>
                                        Tidak Aktif
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('products.show', $product->id) }}"
                                       class="p-2 rounded-lg text-soft-muted hover:bg-primary-50 hover:text-primary-600 transition-colors"
                                       title="Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('products.edit', $product->id) }}"
                                       class="p-2 rounded-lg text-soft-muted hover:bg-secondary-50 hover:text-secondary-600 transition-colors"
                                       title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="p-2 rounded-lg text-soft-muted hover:bg-red-50 hover:text-red-600 transition-colors"
                                                title="Hapus">
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
            <div class="p-12 text-center">
                <div class="w-24 h-24 mx-auto mb-4 rounded-full bg-primary-50 flex items-center justify-center">
                    <svg class="w-12 h-12 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-soft-text mb-2">Belum Ada Produk</h3>
                <p class="text-sm text-soft-muted mb-6">Anda belum menambahkan produk apapun. Mulailah dengan menambahkan produk pertama.</p>
                <a href="{{ route('products.create') }}" class="btn-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah Produk Pertama
                </a>
            </div>
        @endif
    </div>

    @if($products->count() > 0)
        <div class="px-5 py-4 border-t border-soft-border/60">
            {{ $products->links() }}
        </div>
    @endif
</div>

@endsection
