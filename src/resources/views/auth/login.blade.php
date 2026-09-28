@section('title', 'Login')
@section('auth-title', 'Masuk ke Akun')
@section('auth-subtitle', 'Silakan masukkan email dan password Anda.')

<x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="input-label">Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-soft-muted">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </div>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="email@contoh.com"
                    class="input-field pl-11 @error('email') border-red-400 focus:ring-red-300 focus:border-red-400 @enderror"
                >
            </div>
            @error('email')
                <p class="input-error-text flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="input-label !mb-0">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs font-medium text-primary-600 hover:text-primary-700 hover:underline transition-colors">
                        Lupa Password?
                    </a>
                @endif
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-soft-muted">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                    class="input-field pl-11 @error('password') border-red-400 focus:ring-red-300 focus:border-red-400 @enderror"
                >
            </div>
            @error('password')
                <p class="input-error-text">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="mb-6">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input
                    id="remember_me"
                    type="checkbox"
                    name="remember"
                    class="w-4 h-4 rounded border-soft-border text-primary-500 focus:ring-primary-400 focus:ring-offset-0 cursor-pointer"
                >
                <span class="ml-2.5 text-sm text-soft-muted group-hover:text-soft-text transition-colors">
                    Ingat saya
                </span>
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-primary w-full py-3 text-base shadow-card hover:shadow-md transition-shadow">
            <span>Masuk</span>
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
        </button>

        <!-- Divider -->
        <div class="my-6 flex items-center">
            <div class="flex-1 h-px bg-soft-border"></div>
            <span class="px-4 text-xs text-soft-muted">atau</span>
            <div class="flex-1 h-px bg-soft-border"></div>
        </div>

        <!-- Register Link -->
        <p class="text-center text-sm text-soft-muted">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-semibold text-primary-600 hover:text-primary-700 hover:underline transition-colors">
                Daftar sekarang
            </a>
        </p>
    </form>
</x-guest-layout>
