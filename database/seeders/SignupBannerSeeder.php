<?php

namespace Database\Seeders;

use App\Models\SignupCms;
use Illuminate\Database\Seeder;

class SignupBannerSeeder extends Seeder
{

    public function run()
    {
        SignupCms::truncate();

        SignupCms::insert([
            'banner_text'    => 'Register',
            'banner_image'   => 'assets/images/loginBg.jpg',
        ]);
    }
}
