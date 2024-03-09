<?php

namespace App\Http\Controllers;

use App\Actions\Panel\Blog\Category\Interfaces\CategoryInterface;
use App\Models\Category;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryInterface;

    public function __construct(CategoryInterface $categoryInterface)
    {
        $this->categoryInterface = $categoryInterface;

        $this->middleware('permission:view-blogs', ['only'=>['index','categories']]);
        $this->middleware('permission:create-blog', ['only'=>['store']]);
        $this->middleware('permission:delete-blog', ['only'=>['delete']]);
    }

    public function index(): Renderable
    {
        return view('admin.blogs.categories.index');
    }

    public function categories(Request $request): JsonResponse
    {
        return $this->categoryInterface->categories($request);
    }

    public function store(Request $request): JsonResponse
    {
       return $this->categoryInterface->store($request);
    }

    public function delete(Category $category): JsonResponse
    {
        return $this->categoryInterface->delete($category);
    }
}
