<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()
            ->select(['id', 'name', 'created_at', 'updated_at'])
            ->withCount('products')
            ->latest('updated_at')
            ->paginate(10);

        return view('categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique'   => 'Kategori dengan nama tersebut sudah ada.',
            'name.max'      => 'Nama kategori maksimal 100 karakter.',
        ]);

        Category::create($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori "' . e($validated['name']) . '" berhasil ditambahkan.');
    }

    public function edit(Category $category): View
    {
        $category->loadCount('products');

        return view('categories.edit', compact('category'));
    }

    public function show(Category $category): RedirectResponse
    {
        return redirect()->route('categories.index');
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique'   => 'Kategori dengan nama tersebut sudah ada.',
            'name.max'      => 'Nama kategori maksimal 100 karakter.',
        ]);

        $oldName = $category->name;
        $category->update($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui dari "' . e($oldName) . '" menjadi "' . e($validated['name']) . '".');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $relatedProductsCount = $category->products()->count();

        if ($relatedProductsCount > 0) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'Kategori "' . e($category->name) . '" tidak dapat dihapus karena masih digunakan oleh ' . $relatedProductsCount . ' produk. Pindahkan dahulu produk tersebut ke kategori lain.');
        }

        $deletedName = $category->name;
        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori "' . e($deletedName) . '" berhasil dihapus.');
    }
}
