<?php

namespace App\Http\Controllers;

use App\Actions\Panel\Blog\Tag\Interfaces\TagInterface;
use App\Models\Tag;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagInterface;

    public function __construct(TagInterface $tagInterface)
    {
        $this->tagInterface = $tagInterface;
        
        $this->middleware('permission:view-blogs', ['only'=>['index','tags']]);
        $this->middleware('permission:create-blog', ['only'=>['store']]);
        $this->middleware('permission:delete-blog', ['only'=>['delete']]);
    }

    public function index(): Renderable
    {
        return view('admin.blogs.tags.index');
    }

    public function tags(Request $request): JsonResponse
    {
        return $this->tagInterface->tags($request);
    }

    public function store(Request $request): JsonResponse
    {
        return $this->tagInterface->store($request);
    }

    public function delete(Tag $tag): JsonResponse
    {
        return $this->tagInterface->delete($tag);
    }
}
