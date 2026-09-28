<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'KasirKu') - Aplikasi Kasir</title>
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="bg-soft-bg min-h-screen">

    <div id="app-layout" class="flex h-screen overflow-hidden">

        <!-- Mobile Sidebar Overlay -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/40 z-40 lg:hidden hidden" onclick="toggleSidebar()"></div>

        <!-- Sidebar -->
        <aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-white border-r border-soft-border shadow-card transform -translate-x-full lg:translate-x-0 transition-transform duration-300 flex flex-col">

            <!-- Logo -->
            <div class="h-16 flex items-center px-6 border-b border-soft-border">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-400 to-primary-500 flex items-center justify-center shadow-soft">
                        <span class="text-white text-lg font-bold">K</span>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-soft-text">KasirKu</h1>
                        <p class="text-xs text-soft-muted">Aplikasi Kasir</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-4 overflow-y-auto scrollbar-thin space-y-1">
                <a href="{{ route('dashboard') }}"
                   class="{{ request()->routeIs('dashboard') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <span class="text-lg">🏠</span>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('categories.index') }}"
                   class="{{ request()->routeIs('categories.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <span class="text-lg">🏷️</span>
                    <span>Kategori</span>
                </a>

                <a href="{{ route('products.index') }}"
                   class="{{ request()->routeIs('products.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <span class="text-lg">📦</span>
                    <span>Produk</span>
                </a>

                <a href="{{ route('cashier.index') }}"
                   class="{{ request()->routeIs('cashier.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <span class="text-lg">🛒</span>
                    <span>Kasir</span>
                </a>

                <a href="{{ route('transactions.index') }}"
                   class="{{ request()->routeIs('transactions.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <span class="text-lg">🧾</span>
                    <span>Riwayat Transaksi</span>
                </a>
            </nav>

            <!-- Bottom: User & Logout -->
            <div class="p-4 border-t border-soft-border">
                @auth
                    <div class="flex items-center gap-3 mb-3 px-2">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-secondary-300 to-secondary-400 flex items-center justify-center text-white font-semibold shadow-soft">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-soft-text truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-soft-muted truncate">{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="sidebar-link w-full justify-center text-red-600 hover:bg-red-50 hover:text-red-700">
                            <span class="text-lg">🚪</span>
                            <span>Keluar</span>
                        </button>
                    </form>
                @endauth
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Topbar -->
            <header class="h-16 bg-white border-b border-soft-border shadow-soft flex items-center justify-between px-4 lg:px-8 flex-shrink-0">

                <div class="flex items-center gap-4">
                    <!-- Mobile Menu Toggle -->
                    <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-xl hover:bg-primary-50 text-soft-muted hover:text-primary-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <!-- Page Title -->
                    <div>
                        <h2 class="text-lg lg:text-xl font-bold text-soft-text">
                            @yield('page-title', 'Dashboard')
                        </h2>
                        @hasSection('page-subtitle')
                            <p class="text-xs lg:text-sm text-soft-muted hidden sm:block">
                                @yield('page-subtitle')
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Right Side -->
                <div class="flex items-center gap-3">
                    <!-- Welcome Text -->
                    <div class="hidden md:flex items-center gap-3">
                        <div class="text-right">
                            <p class="text-xs text-soft-muted">Selamat datang kembali,</p>
                            <p class="text-sm font-semibold text-soft-text">{{ auth()->user()->name ?? 'User' }}</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-300 to-primary-400 flex items-center justify-center text-white font-semibold shadow-soft">
                            {{ auth()->check() ? strtoupper(substr(auth()->user()->name, 0, 1)) : 'U' }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto scrollbar-thin p-4 lg:p-8">

                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="alert-success">
                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert-error">
                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>{{ session('error') }}</div>
                    </div>
                @endif

                @if (session('warning'))
                    <div class="alert-warning">
                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div>{{ session('warning') }}</div>
                    </div>
                @endif

                @if (session('info') || session('status'))
                    <div class="alert-info">
                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>{{ session('info') ?? session('status') }}</div>
                    </div>
                @endif

                <!-- Page Content -->
                <div id="page-content">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>

</body>
</html>
