<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SignupBannerSeeder extends Seeder
{
    
    public function run()
    {
        \App\Models\SignupCms::insert([
            'banner_text'    => 'Register',
            'banner_image'   => 'assets/images/loginBg.jpg',
        ]);
    }
}
