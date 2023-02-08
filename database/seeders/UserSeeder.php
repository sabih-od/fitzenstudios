<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::truncate();

        User::insert([
            'name' => 'Admin',
            'email' => 'admin@fitzenstudio.com',
            'password' => bcrypt('admin!@#'),
            'role_id' => 1
        ]);

//        User::insert([
//            'name' => 'custo',
//            'email' => 'custo@fitzenstudio.com',
//            'password' => bcrypt('12345'),
//            'role_id' => 2
//        ]);
//        User::insert([
//            'name' => 'traino',
//            'email' => 'traino@fitzenstudio.com',
//            'password' => bcrypt('12345'),
//            'role_id' => 3
//        ]);
    }
}
