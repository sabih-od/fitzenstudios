<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::insert([
            'name' => 'Admin',
            'email' => 'admin@fitzenstudio.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin@fitzen'),
            'role_id' => 1
        ]);
    }
}
