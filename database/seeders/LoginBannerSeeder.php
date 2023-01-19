<?php

namespace Database\Seeders;
use App\Models\LoginCms;
use Illuminate\Database\Seeder;

class LoginBannerSeeder extends Seeder
{

    public function run()
    {
        LoginCms::truncate();

        LoginCms::insert([
            'banner_text'    => 'Sign In',
            'banner_image'   => 'assets/images/loginBg.jpg',
        ]);
    }
}
