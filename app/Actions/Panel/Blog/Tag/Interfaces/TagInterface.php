<?php

namespace App\Actions\Panel\Blog\Tag\Interfaces;

use App\Models\Tag;

interface TagInterface
{
    public function tags($request);
    public function store($request);
    public function delete(Tag $tag);
}
