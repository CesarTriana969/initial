<?php

namespace App\Actions\Panel\Blog\Tag;

use App\Actions\Panel\Blog\Tag\Interfaces\TagInterface;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;

class TagAction implements TagInterface
{
    public function tags($request): JsonResponse
    {
        $search = $request->search;
        $categories = Tag::where('id', 'LIKE', '%'.$search.'%')
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

        $tag = Tag::create($data);
        return response()->json(['success' => true, 'tag' => $tag]);
    }

    public function delete(Tag $tag): JsonResponse
    {
        if ($tag) {
            $tag->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'Category not found'], 404);
    }
}
