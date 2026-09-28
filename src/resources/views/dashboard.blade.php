@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan dan statistik toko Anda hari ini.')

@extends('layouts.app')

@section('content')

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6 lg:mb-8">

    <!-- Total Sales Card -->
    <div class="card p-5 lg:p-6 bg-gradient-to-br from-primary-50 to-white border-primary-100">
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-primary-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <span class="badge-info">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
                Hari Ini
            </span>
        </div>
        <h3 class="text-sm font-medium text-soft-muted mb-1">Total Penjualan</h3>
        <p class="text-2xl lg:text-3xl font-bold text-soft-text">
            Rp {{ number_format($todaySales, 0, ',', '.') }}
        </p>
    </div>

    <!-- Transaction Count Card -->
    <div class="card p-5 lg:p-6 bg-gradient-to-br from-secondary-50 to-white border-secondary-100">
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-secondary-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
            </div>
            <span class="badge-warning">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Hari Ini
            </span>
        </div>
        <h3 class="text-sm font-medium text-soft-muted mb-1">Jumlah Transaksi</h3>
        <p class="text-2xl lg:text-3xl font-bold text-soft-text">
            {{ $todayCount }}
            <span class="text-base font-medium text-soft-muted">transaksi</span>
        </p>
    </div>

    <!-- Quick Actions Card 1 -->
    <a href="{{ route('cashier.index') }}" class="card p-5 lg:p-6 hover:shadow-card transition-all duration-200 hover:-translate-y-0.5 group cursor-pointer">
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <svg class="w-5 h-5 text-soft-muted group-hover:text-primary-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
        </div>
        <h3 class="text-sm font-medium text-soft-muted mb-1">Mulai Transaksi</h3>
        <p class="text-xl font-bold text-soft-text">Kasir</p>
    </a>

    <!-- Quick Actions Card 2 -->
    <a href="{{ route('products.index') }}" class="card p-5 lg:p-6 hover:shadow-card transition-all duration-200 hover:-translate-y-0.5 group cursor-pointer">
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
            <svg class="w-5 h-5 text-soft-muted group-hover:text-primary-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
        </div>
        <h3 class="text-sm font-medium text-soft-muted mb-1">Kelola Barang</h3>
        <p class="text-xl font-bold text-soft-text">Daftar Produk</p>
    </a>
</div>

<!-- Ringkasan Hari Ini Section -->
<div class="card p-5 lg:p-6 mb-6">
    <div class="flex items-center gap-3 mb-5">
        <div class="w-10 h-10 rounded-xl bg-primary-100 flex items-center justify-center">
            <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        </div>
        <div>
            <h2 class="text-lg font-bold text-soft-text">Ringkasan Hari Ini</h2>
            <p class="text-sm text-soft-muted">
                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="p-4 rounded-xl bg-primary-50/70 border border-primary-100">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <span class="text-xs font-medium text-primary-700">Rata-rata / Transaksi</span>
            </div>
            <p class="text-xl font-bold text-soft-text">
                Rp {{ $todayCount > 0 ? number_format($todaySales / $todayCount, 0, ',', '.') : '0' }}
            </p>
        </div>

        <a href="{{ route('transactions.index') }}" class="p-4 rounded-xl bg-secondary-50/70 border border-secondary-100 hover:shadow-soft transition-all group">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-8 h-8 rounded-lg bg-secondary-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <span class="text-xs font-medium text-secondary-700">Lihat Riwayat →</span>
            </div>
            <p class="text-xl font-bold text-soft-text">Riwayat Transaksi</p>
        </a>

        <a href="{{ route('products.create') }}" class="p-4 rounded-xl bg-green-50/70 border border-green-100 hover:shadow-soft transition-all group">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <span class="text-xs font-medium text-green-700">Tambah Produk →</span>
            </div>
            <p class="text-xl font-bold text-soft-text">Kelola Produk</p>
        </a>
    </div>
</div>

<!-- Empty State when no data -->
@if($todayCount === 0)
    <div class="card p-8 lg:p-12 text-center">
        <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-secondary-100 flex items-center justify-center">
            <svg class="w-10 h-10 text-secondary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 8v8m-4-5v5m8-8v5m6 3v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-soft-text mb-2">Belum Ada Transaksi Hari Ini</h3>
        <p class="text-sm text-soft-muted mb-6">Mulailah transaksi pertama Anda untuk melihat statistik penjualan di sini.</p>
        <a href="{{ route('cashier.index') }}" class="btn-primary inline-flex">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Mulai Kasir
        </a>
    </div>
@endif

@endsection
