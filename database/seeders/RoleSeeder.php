<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        Role::insert([
            'name' => 'Admin',
        ]);

        Role::insert([
            'name' => 'Customer',
        ]);

        Role::insert([
            'name' => 'Trainer',
        ]);
    }
}
