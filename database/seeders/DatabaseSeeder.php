<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PermissionsSeeder::class,
        ]);

        $rol = Role::create(['name' => 'Admin']);

        $permisos = Permission::pluck('id')->all();
        $adminPermissions = Permission::whereIn('name', [  
        'view-users',
        'create-user',
        'edit-user',
        'delete-user',
        'block-user',

        'view-calendar-dashboard',

        'view-clients',
        'create-client',
        'edit-client',
        'delete-client',

        'view-services',
        'create-service',
        'edit-service',
        'delete-service',

        // roles table
        'view-roles',
        'create-role',
        'edit-role',
        'delete-role',

        'view-leads',
        'delete-lead',

        'view-blogs',
        'create-blog',
        'edit-blog',
        'delete-blog',
        
        'view-content-services',
        'create-content-services',
        'edit-content-services',
        'delete-content-service',
        'view-company',
        'update-company'
        ])->pluck('id');

        $rol->syncPermissions($adminPermissions);

        $user = User::create([
            'name' => 'Manager',
            'email' => 'manager@ingesoftllc.com',
            'microsoft_account_id' => 'd716137b-f735-41df-bac7-07e96c37979b',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'color' => '#EAC62E'
        ]);

        $user->assignRole('Admin');

        $preparerRole = Role::create(['name' => 'Preparer']);

        $preparerPermissions = Permission::whereIn('name', [
            'create-user',
            'edit-user',
            'delete-user',
            'block-user',
    
            'view-clients',
            'create-client',
            'edit-client',
            'delete-client',
    
            'view-services',
            'create-service',
            'edit-service',
            'delete-service',
    
            // roles table
            'view-roles',
            'create-role',
            'edit-role',
            'delete-role',

            'view-leads',
            'delete-lead',
            'view-blogs',
            'create-blog',
            'edit-blog',
            'delete-blog',
            'view-content-services',
            'create-content-services',
            'edit-content-services',
            'delete-content-service',
            'view-company',
            'update-company'
            ])->pluck('id');
        $preparerRole->syncPermissions($preparerPermissions);

        $user2 = User::create([
            'name' => 'Senior',
            'email' => 'seniordeveloper@ingesoftllc.com',
            'email_verified_at' => now(),
            'microsoft_account_id' => '39a61c90-a806-4b9c-8802-87b3e58f9090',
            'password' => bcrypt('12345678'),
            'color' => '#E95E5A'
        ]);

        $user2->assignRole('Preparer');

        $this->call(CustomerSeeder::class);

        $this->call([
            AuthorsTableSeeder::class,
            CategoriesTableSeeder::class,
            BlogsTableSeeder::class,
            CompanyProfileSeeder::class,
            SiteServiceSeeder::class,
            ServiceFaqSeeder::class,
        ]);
    }
}
