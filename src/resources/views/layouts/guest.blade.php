<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'KasirKu') - Aplikasi Kasir</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-gradient-to-br from-primary-50 via-white to-secondary-50 font-sans antialiased">

        <!-- Background Decorations -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
            <div class="absolute -top-20 -right-20 w-96 h-96 bg-primary-200 rounded-full mix-blend-multiply filter blur-3xl opacity-40"></div>
            <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-secondary-200 rounded-full mix-blend-multiply filter blur-3xl opacity-40"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-primary-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
        </div>

        <!-- Flash Messages -->
        <div class="fixed top-4 left-1/2 -translate-x-1/2 z-50 w-full max-w-md px-4">
            @if (session('success'))
                <div class="alert-success shadow-card animate-[fadeIn_0.3s_ease-out]">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>{{ session('success') }}</div>
                </div>
            @endif
            @if (session('error'))
                <div class="alert-error shadow-card animate-[fadeIn_0.3s_ease-out]">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>{{ session('error') }}</div>
                </div>
            @endif
        </div>

        <!-- Main Container -->
        <div class="relative z-10 min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4 py-12">

            <!-- Logo -->
            <div class="mb-8 text-center">
                <a href="/" class="inline-flex items-center gap-4 group">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-primary-400 to-primary-500 flex items-center justify-center shadow-card group-hover:shadow-lg transition-all duration-300 group-hover:scale-105">
                        <span class="text-white text-2xl font-bold">K</span>
                    </div>
                    <div class="text-left">
                        <h1 class="text-2xl font-bold text-soft-text">KasirKu</h1>
                        <p class="text-sm text-soft-muted">Aplikasi Kasir Sederhana</p>
                    </div>
                </a>
            </div>

            <!-- Auth Card -->
            <div class="w-full sm:max-w-md">
                <div class="card p-6 sm:p-8 shadow-card">
                    <!-- Page Title -->
                    <div class="mb-6 text-center sm:text-left">
                        <h2 class="text-xl font-bold text-soft-text mb-1">@yield('auth-title', 'Masuk ke Akun')</h2>
                        <p class="text-sm text-soft-muted">@yield('auth-subtitle', 'Silakan masukkan detail akun Anda.')</p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="mb-4 p-3 rounded-xl bg-primary-50 text-primary-700 text-sm border border-primary-100">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ $slot }}
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center text-xs text-soft-muted">
                <p>&copy; {{ date('Y') }} KasirKu. Dibuat dengan ❤️ untuk UMKM Indonesia.</p>
            </div>
        </div>

        <style>
            @keyframes fadeIn {
                from { opacity: 0; transform: translate(-50%, -10px); }
                to { opacity: 1; transform: translate(-50%, 0); }
            }
        </style>
    </body>
</html>
