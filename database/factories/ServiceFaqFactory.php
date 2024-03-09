<?php

namespace Database\Factories;

use App\Models\SiteService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceFaq>
 */
class ServiceFaqFactory extends Factory
{
    protected $model = \App\Models\ServiceFaq::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $siteService = SiteService::all()->random() ?? SiteService::factory()->create();

        return [
            'site_service_id' => $siteService->id,
            'faq' => $this->faker->sentence(),
            'column_number' => $this->faker->randomElement([1, 2]),
        ];
    }
}
