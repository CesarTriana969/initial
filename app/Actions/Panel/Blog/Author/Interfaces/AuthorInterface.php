<?php

namespace App\Actions\Panel\Blog\Author\Interfaces;

use App\Models\Author;

interface AuthorInterface
{
    public function authors( $request);
    public function store($request);
    public function delete(Author $author);
}
