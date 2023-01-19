<?php

namespace Database\Seeders;

use App\Models\HeaderCMS;
use Illuminate\Database\Seeder;

class HeaderCMSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HeaderCMS::truncate();

        HeaderCMS::insert([
            'logo'       => 'assets/images/logo.png',
            'link_one'   => 'Home',
            'link_two'   => "About Us",
            'link_three' => "FAQS",
            "link_four"  => "Contact Us",
            "link_five"  => "Login",
            "link_six"   => "Sign Up"
        ]);
    }
}
