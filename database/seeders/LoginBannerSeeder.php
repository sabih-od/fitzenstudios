<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class LoginBannerSeeder extends Seeder
{
   
    public function run()
    {
        \App\Models\LoginCms::insert([
            'banner_text'    => 'Sign In',
            'banner_image'   => 'assets/images/loginBg.jpg',
        ]);
    }
}
