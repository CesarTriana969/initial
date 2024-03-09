<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tagNames = ['PHP', 'Laravel', 'JavaScript', 'Vue.js', 'React', 'Database', 'HTML', 'CSS', 'Design', 'SEO'];

        foreach ($tagNames as $tagName) {
            $tag = Tag::create(['name' => $tagName]);

            $blogs = Blog::inRandomOrder()->take(rand(1, 5))->get();
            foreach ($blogs as $blog) {
                $blog->tags()->attach($tag->id);
            }
        }
    }
}
