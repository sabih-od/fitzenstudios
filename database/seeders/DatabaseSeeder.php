<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(Create_homepage_cms_seeder::class);
        $this->call(create_aboutus_cms_table_seeder::class);
        $this->call(create_privacypolicy_cms_table_seeder::class);
        $this->call(create_terms_cms_table_seeder::class);
        $this->call(create_contactus_cms_table_seeder::class);
        $this->call(create_footer_cms_table_seeder::class);
        $this->call(HeaderCMSSeeder::class);
        $this->call(DemoSessionCMSSeeder::class);
        $this->call(FAQBannerSeeder::class);
        $this->call(LoginBannerSeeder::class);
        $this->call(SignupBannerSeeder::class);
    }
}
