<?php

namespace App\Http\Controllers;

use App\Actions\Panel\Blog\Interfaces\BlogInterface;
use App\Models\Blog;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $blogInterface;

    public function __construct(BlogInterface $blogInterface)
    {
        $this->blogInterface = $blogInterface;

        $this->middleware('permission:view-blogs', ['only'=>['index','blogs']]);
        $this->middleware('permission:create-blog', ['only'=>['create','store']]);
        $this->middleware('permission:edit-blog', ['only'=>['edit','update', 'updatePicture', 'updateStatus']]);
        $this->middleware('permission:delete-blog', ['only'=>['destroy']]);
    }

    public function index(): Renderable
    {
        return view('admin.blogs.index');
    }

    public function blogs(Request $request): JsonResponse
    {
       return $this->blogInterface->blogs($request);
    }

    public function create(): Renderable
    {
       return $this->blogInterface->create();
    }

    public function store(Request $request): JsonResponse
    {
        return $this->blogInterface->store($request);
    }

    public function edit($blog): Renderable
    {
        return $this->blogInterface->edit($blog);
    }

    public function updatePicture(Request $request, Blog $blog): JsonResponse
    {
       return $this->blogInterface->updatePicture($request, $blog);
    }

    public function update(Request $request, $blog): JsonResponse
    {
        return $this->blogInterface->update($request, $blog);

    }
    
    public function destroy(Request $request): JsonResponse
    {
        return $this->blogInterface->destroy($request);
    }

    public function updateStatus(Request $request, Blog $blog): JsonResponse
    {
        return $this->blogInterface->updateStatus($request, $blog);
    }
}
