<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'first_name'    => 'John',
            'last_name'     => 'Doe',
            'email'         => 'john.doe@example.com',
            'phone_number'  => '123456789',
            'company_name'  => 'Doe Enterprises',
            'birth_day'     => '1990-01-01',
            'address'       => '123 Main St.',
            'apt'           => 'Apt 4B',
            'city'          => 'Sample City',
            'state'         => 'ST',
            'zip_code'      => '12345',
        ]);
    }
}
