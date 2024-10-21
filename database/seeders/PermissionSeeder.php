<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create([
             'permission_name' => 'read'
        ]);

        Permission::create([
            'permission_name' => 'create'
       ]);

        Permission::create([
        'permission_name' => 'update'
        ]);

        Permission::create([
            'permission_name' => 'delete'
        ]);
    }
}
