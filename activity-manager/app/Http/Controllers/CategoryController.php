<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $service)
    {
    }

    public function index(): View
    {
        $categories = Category::withCount('activities')->orderBy('name')->get();
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
        ]);

        Category::create($data);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $this->service->deleteCategory($category);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}