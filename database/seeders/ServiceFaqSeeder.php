<?php

namespace Database\Seeders;

use App\Models\ServiceFaq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceFaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceFaq::factory(20)->create();
    }
}
