<?php

namespace App\Actions\Panel\Blog\Interfaces;

use App\Models\Blog;

interface BlogInterface
{
    public function blogs($request);
    public function create();
    public function store($request);
    public function edit($blog);
    public function updatePicture($request, Blog $blog);
    public function update($request, $blog);
    public function destroy($request);
    public function updateStatus($request, Blog $blog);
}
