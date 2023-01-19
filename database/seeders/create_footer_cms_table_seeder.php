<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class create_footer_cms_table_seeder extends Seeder
{
    public function run()
    {
        \App\Models\FooterCMS::insert([
            "footer_image" => "assets/images/footerBg.jpg",
            "heading_one"  => "Quick Links",
            "link_one"     => "FAQs",
            "link_two"     => "Privacy policies",
            "link_three"   => "Terms and Conditions",
            "link_four"    => "Contact Us",
            "heading_two"  => "Newsletter",
            "heading_three" => "Social Media",
            "facebook_link" => "javascript:;",
            "twitter_link" => "javascript:;",
            "instagram_link" => "javascript:;",
            "linkedin_link" => "javascript:;",
            "note" => "Copyright © 2022 All Rights Reserved.",
            "logo_image" => "assets/images/footerLogo.png",
        ]);
    }
}
