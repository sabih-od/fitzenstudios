<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class create_contactus_cms_table_seeder extends Seeder
{
  
    public function run()
    {
        \App\Models\ContactCMS::insert([
            "banner_heading"      => "Contact Us",
            "banner_image"        => "assets/images/contantbg.png",
            "section_heading"     => "Contact Us",
            "section_sub_heading" => "Fitzen.Studio",
            "location_heading"    => "LOCATION",
            "location"            => "Admin Office: 19 A-D, Devi Residency,
            Thudiyalur, Coimbatore 641034, INDIA",
            "email_heading"       => "EMAIL ADDRESS",
            "email"               => "sanjana@fitzen.studio",
            "phone_heading"       => "PHONE NUMBER",
            "phone"               => "+91-8248773982 / +91-8754037174",
            "map"                 => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3744744.6253010477!2d-102.56163816871374!3d39.57901766315014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited%20States!5e0!3m2!1sen!2s!4v1633689177080!5m2!1sen!2s"
        ]);
    }
}
