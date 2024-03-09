<?php

namespace App\Http\Controllers;

use App\Actions\Panel\Blog\Author\Interfaces\AuthorInterface;
use App\Models\Author;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    protected $authorInterface;

    public function __construct(AuthorInterface $authorInterface)
    {
        $this->authorInterface = $authorInterface;

        $this->middleware('permission:view-blogs', ['only'=>['index','authors']]);
        $this->middleware('permission:create-blog', ['only'=>['store']]);
        $this->middleware('permission:delete-blog', ['only'=>['delete']]);
    }

    public function index(): Renderable
    {
        return view('admin.blogs.authors.index');
    }

    public function authors(Request $request): JsonResponse
    {
       return $this->authorInterface->authors($request);
    }

    public function store(Request $request): JsonResponse
    {
        return $this->authorInterface->store($request);
    }

    public function delete(Author $author): JsonResponse
    {
        return $this->authorInterface->delete($author);
    }
}
