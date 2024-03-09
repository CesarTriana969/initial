<?php

namespace Database\Seeders;

use App\Models\CompanyProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyProfile::create([
            'name' => 'ingesoftllc',
            'email' => 'camiloandres00410@gmail.com',
            'phone_number' => '8604224703',
            'fax' => '35 Pearl St suite 103, New Britain, CT 06051 1st floor',
            'instagram' => 'instagram.com',
            'facebook' => 'facebook.com',
        ]);
    }
}
