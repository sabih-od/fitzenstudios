<?php

namespace Database\Seeders;

use App\Models\DemoSessionCMS;
use Illuminate\Database\Seeder;

class DemoSessionCMSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DemoSessionCMS::truncate();

        DemoSessionCMS::insert([
            'heading'   => 'BOOK A DEMO SESSION',
            'content'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor <br> incididunt ut labore et dolore magna aliqua.',
            'image'     => "assets/images/logoform.png"
        ]);
    }
}
