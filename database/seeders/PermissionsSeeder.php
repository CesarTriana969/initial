<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
        public function run(): void
        { 
            $permissions = [
            // user table
            'view-users',
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
        ];

        foreach($permissions as $permission){
            Permission::create(['name'=>$permission]);
        }
    }
}
