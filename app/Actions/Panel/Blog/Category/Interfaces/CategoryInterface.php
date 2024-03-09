<?php

namespace App\Actions\Panel\Blog\Category\Interfaces;

use App\Models\Category;

interface CategoryInterface
{
    public function categories($request);
    public function store($request);
    public function delete(Category $category);
}
