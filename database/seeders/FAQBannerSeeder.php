<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FAQBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\FaqBannerCMS::insert([
            'banner_heading'   => 'FAQS',
            'banner_image'   => "assets/images/faqBnnr.jpg",
        
        ]);
    }
}
