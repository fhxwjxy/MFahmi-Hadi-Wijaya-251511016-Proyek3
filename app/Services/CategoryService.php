<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Validation\ValidationException;

class CategoryService
{
    public function deleteCategory(Category $category): void
    {
        if ($category->activities()->exists()) {
            throw ValidationException::withMessages([
                'category' => "Kategori '{$category->name}' masih digunakan oleh kegiatan lain dan tidak dapat dihapus.",
            ]);
        }

        $category->delete();
    }
}