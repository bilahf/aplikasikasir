@php($product = $product ?? null)

<div class="space-y-5">

    <!-- Nama Produk -->
    <div>
        <label for="name" class="input-label">
            Nama Produk <span class="text-red-500">*</span>
        </label>
        <input
            id="name"
            type="text"
            name="name"
            placeholder="Masukkan nama produk"
            value="{{ old('name', $product?->name) }}"
            required
            class="input-field @error('name') border-red-400 focus:ring-red-300 focus:border-red-400 @enderror"
        >
        @error('name')
            <p class="input-error-text flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ $message }}
            </p>
        @enderror
    </div>

    <!-- Kategori & Harga -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label for="category_id" class="input-label">
                Kategori <span class="text-red-500">*</span>
            </label>
            <select
                id="category_id"
                name="category_id"
                required
                {{ $categories->isEmpty() ? 'disabled' : '' }}
                class="input-field @error('category_id') border-red-400 focus:ring-red-300 focus:border-red-400 @enderror"
            >
                <option value="" disabled {{ !old('category_id', $product?->category_id) ? 'selected' : '' }}>
                    {{ $categories->isEmpty() ? 'Belum ada kategori di database' : 'Pilih kategori' }}
                </option>
                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id', $product?->category_id) == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="input-error-text">{{ $message }}</p>
            @enderror

            @if ($categories->isEmpty())
                <div class="mt-3 p-4 rounded-xl bg-warning-50 border border-warning-200 text-warning-700 text-sm flex items-start gap-3">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <div>
                        <p class="font-semibold mb-1">Belum ada kategori tersedia.</p>
                        <p class="mb-2">Anda harus menambahkan kategori terlebih dahulu sebelum menambah atau mengedit produk.</p>
                        <a href="{{ route('categories.create') }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-secondary-500 hover:bg-secondary-600 text-white font-medium text-xs transition-colors shadow-soft">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Tambah Kategori Sekarang
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <div>
            <label for="price" class="input-label">
                Harga (Rp) <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-soft-muted font-medium">
                    Rp
                </div>
                <input
                    id="price"
                    type="number"
                    name="price"
                    min="0"
                    placeholder="0"
                    value="{{ old('price', $product?->price) }}"
                    required
                    class="input-field pl-12 @error('price') border-red-400 focus:ring-red-300 focus:border-red-400 @enderror"
                >
            </div>
            @error('price')
                <p class="input-error-text">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Stok & Status Aktif -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label for="stock" class="input-label">
                Stok <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-soft-muted">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <input
                    id="stock"
                    type="number"
                    name="stock"
                    min="0"
                    placeholder="0"
                    value="{{ old('stock', $product?->stock) }}"
                    required
                    class="input-field pl-11 @error('stock') border-red-400 focus:ring-red-300 focus:border-red-400 @enderror"
                >
            </div>
            @error('stock')
                <p class="input-error-text">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status Aktif -->
        <div class="flex flex-col justify-end">
            <label class="input-label">Status Produk</label>
            <label class="inline-flex items-center cursor-pointer group p-3 rounded-xl border border-soft-border bg-soft-bg/50 hover:bg-primary-50/50 transition-colors">
                <input
                    type="hidden"
                    name="is_active"
                    value="0"
                >
                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    {{ old('is_active', $product?->is_active ?? true) ? 'checked' : '' }}
                    class="sr-only peer"
                >
                <div class="relative w-12 h-6 bg-soft-border rounded-full peer peer-checked:after:translate-x-6 peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-500 shadow-inner"></div>
                <span class="ml-3 text-sm font-medium text-soft-text group-hover:text-primary-600 transition-colors">
                    Tampilkan di kasir
                </span>
            </label>
        </div>
    </div>

    <!-- Deskripsi -->
    <div>
        <label for="description" class="input-label">Deskripsi Produk</label>
        <textarea
            id="description"
            name="description"
            rows="4"
            placeholder="Masukkan deskripsi produk (opsional)"
            class="input-field resize-y @error('description') border-red-400 focus:ring-red-300 focus:border-red-400 @enderror"
        >{{ old('description', $product?->description) }}</textarea>
        @error('description')
            <p class="input-error-text">{{ $message }}</p>
        @enderror
    </div>

</div>
