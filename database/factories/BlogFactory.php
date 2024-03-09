<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{

    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
            return [
                'title' => $this->faker->sentence(),
                'description' => $this->faker->paragraph(),
                'body' => $this->faker->paragraphs(5, true),
                'path_image' => $this->faker->imageUrl(),
                'alt_attribute' => $this->faker->sentence(3),
                'author_id' => rand(1, 3), 
                'category_id' => rand(1, 3),
                'slug' => $this->faker->slug(),
                'keywords' => $this->faker->word(),
                'meta_title' => $this->faker->sentence(5)
            ];
    }
}
