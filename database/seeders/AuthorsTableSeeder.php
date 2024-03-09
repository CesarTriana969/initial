<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create(['name' => 'John Doe']);
        Author::create(['name' => 'Jane Smith']);
        Author::create(['name' => 'Alice Johnson']);
    }
}
