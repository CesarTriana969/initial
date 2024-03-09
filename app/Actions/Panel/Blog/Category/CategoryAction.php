<?php

namespace App\Actions\Panel\Blog\Category;

use App\Actions\Panel\Blog\Category\Interfaces\CategoryInterface;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryAction implements CategoryInterface
{
    public function categories($request): JsonResponse
    {
        $search = $request->search;
        $categories = Category::where('id', 'LIKE', '%'.$search.'%')
                ->orwhere('name', 'LIKE', '%'.$search.'%')
                ->orderBy('id', 'desc')
                ->paginate();

        return response()->json($categories);
    }

    public function store($request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author = Category::create($data);
        return response()->json(['success' => true, 'author' => $author]);
    }

    public function delete(Category $category): JsonResponse
    {
        if ($category) {
            $category->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'Category not found'], 404);
    }
}
