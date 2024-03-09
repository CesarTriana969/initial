<?php

namespace Database\Factories;

use App\Models\SiteService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SiteService>
 */
class SiteServiceFactory extends Factory
{
 
    protected $model = \App\Models\SiteService::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $assignParent = $this->faker->boolean(50);

        if ($assignParent) {
            $parent_id = SiteService::inRandomOrder()->value('id') ?? null;
        } else {
            $parent_id = null;
        }

        return [
            'title' => $this->faker->sentence(),
            'subtitle' => $this->faker->sentence(),
            'meta_title' => $this->faker->sentence(),
            'meta_description' => $this->faker->text(),
            'slug' => $this->faker->slug(),
            'status' => $this->faker->boolean(),
            'quote' => $this->faker->boolean(),
            'parent_id' => $parent_id,
        ];
    }
}
