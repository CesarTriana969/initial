<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'body',
        'path_image',
        'alt_attribute',
        'author_id',
        'slug',
        'category_id',
        'keywords',
        'meta_title',
        'status',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'date:Y-m-d',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    protected function pathImage(): Attribute
    {
        return new Attribute(
            get: fn($value) => !empty($value) ? Storage::url($value) : null,
        );
    }
    
}
