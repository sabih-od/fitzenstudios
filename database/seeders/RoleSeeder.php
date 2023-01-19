<?php

namespace Database\Seeders;

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
        \App\Models\Role::insert([
            'name' => 'Admin',            
        ]);

        \App\Models\Role::insert([
            'name' => 'Customer',            
        ]);

        \App\Models\Role::insert([
            'name' => 'Trainer',            
        ]);
    }
}
