<?php

namespace App\Actions\Panel\Blog;

use App\Actions\Panel\Blog\Interfaces\BlogInterface;
use App\Models\Author;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;

class BlogAction implements BlogInterface
{
    public function blogs($request): JsonResponse
    {
        $search = $request->search;
        $blogs = Blog::where('id', 'LIKE', '%'.$search.'%')
                ->orwhere('title', 'LIKE', '%'.$search.'%')
                ->orwhere('description', 'LIKE', '%'.$search.'%')
                ->orwhere('body', 'LIKE', '%'.$search.'%')
                ->with(['author', 'category', 'tags'])
                ->orderBy('id', 'desc')
                ->paginate();
        return response()->json($blogs);
    }

    public function create(): Renderable
    {
        $authors = Author::all();
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.blogs.create', compact('authors', 'categories', 'tags'));
    }

    public function store($request): JsonResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'meta_title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug',
            'alt_attribute' => 'nullable|string|max:255',
            'created_at' => 'required|date',
            'description' => 'nullable|string',
            'author_id' => 'required|exists:authors,id',
            'body' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'keywords' => 'nullable|string',
        ]);

        $blog = Blog::create($data);
        
        if ($request->has('tags')) {
            $tagsString = $request->input('tags');
            $tagsString = str_replace('[object Object]', '', $tagsString);
            $tagsArray = json_decode($tagsString, true);
            if (json_decode($tagsString) === null && json_last_error() !== JSON_ERROR_NONE) {
                logger('Error al decodificar JSON: ' . json_last_error_msg());
                return response()->json(['error' => 'Formato de tags inválido'], 400);
            }
            $tagIds = collect($tagsArray)->pluck('id')->all();
            $blog->tags()->sync($tagIds);
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('blog-images', 'public');
            $blog->update(['path_image' => $path]);
        }

        return response()->json(['success' => true, 'blog' => $blog]);
    }

    public function edit($blog): Renderable
    {
        $blog = Blog::with(['author', 'category', 'tags'])->find($blog);
        $authors = Author::all();
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.blogs.edit', compact('blog', 'authors', 'categories', 'tags'));
    }

    public function updatePicture($request, Blog $blog): JsonResponse
    {
        if ($request->hasFile('path_image')) {
            $path = $request->file('path_image')->store('blog-images', 'public');
            $blog->update(['path_image' => $path]);
        }
    
        return response()->json(['success' => true, 'path' => $path]);
    }

    public function update($request, $blog): JsonResponse
    {
        $blog = Blog::find($blog);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'meta_title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'alt_attribute' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'author_id' => 'required|exists:authors,id',
            'body' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'keywords' => 'nullable|string',
            'created_at' => 'required|date',
        ]);

        $blog->update($data);

        if ($request->has('tags')) {
            $tagIds = collect($request->input('tags'))->pluck('id')->all();
            $blog->tags()->sync($tagIds);
        }

        return response()->json(['success' => true, 'blog' => $blog]);
    }

    public function destroy($request){
        $blogs = json_decode($request->blogs);
        
        foreach($blogs as $blog){
            Blog::find($blog)->delete();
        }

        return response()->json([
            'message' => '¡Deleted successfully!.',
        ], 200);
    }

    public function updateStatus($request, Blog $blog): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'status' => 'required|boolean',
            ]);

            $blog->status = $validatedData['status'];
            $blog->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error updating status: ' . $e->getMessage()], 500);
        }
    }
}
