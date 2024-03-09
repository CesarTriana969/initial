<?php

namespace App\Actions\Panel\Blog\Author;

use App\Actions\Panel\Blog\Author\Interfaces\AuthorInterface;
use App\Models\Author;
use Illuminate\Http\JsonResponse;

class AuthorAction implements AuthorInterface
{
    public function authors( $request): JsonResponse
    {
        $search = $request->search;
        $authors = Author::where('id', 'LIKE', '%'.$search.'%')
                ->orwhere('name', 'LIKE', '%'.$search.'%')
                ->orderBy('id', 'desc')
                ->paginate();

        return response()->json($authors);
    }

    public function store($request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author = Author::create($data);

        return response()->json(['success' => true, 'author' => $author]);
    }

    public function delete(Author $author): JsonResponse
    {
        if ($author) {
            $author->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'Author not found'], 404);
    }
}
