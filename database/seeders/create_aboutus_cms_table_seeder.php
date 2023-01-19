<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class create_aboutus_cms_table_seeder extends Seeder
{
   
    public function run()
    {
        \App\Models\AboutUsCMS::insert([
            'banner_heading'      => "About Us",
            'banner_image'        => "assets/images/aboutInnr.jpg",
            'section_one_heading' => "A Little Bit About Me",
            'section_one_content' => " <p class='wow fadeInUp' data-wow-delay='0.5s'>I am Sanjay, co-founder and fitness mentor at FitZen.
            I am a man of few words who firmly believes in letting my action do all the speaking. I am a
            certified personal trainer with multiple international certifications under my belt. I am also a
            national amateur boxing champion. As an aside I do hope to turn professional someday .</p>

            <p class='wow fadeInUp' data-wow-delay='0.65s'>I am resident of Coimbatore, Tamil Nadu, also called
                as Manchester of India known for its salubrious climate and its world class heavy machinery
                engineering industry. On any given day you will find me running/jogging around the block,
                cycling, in the boxing ring packing a mean punch, training my clients, planning innovative and
                fun workouts, vlogging amongst other things.
            </p>",
            'section_one_extra_content' => " <p class='wow fadeInUp' data-wow-delay='0.75s'>Here at FitMonk we believe in fitness is way of life.
            We want to fuse together fitness, an active lifestyle and clean healthy eating to become a
            better and fitter version of you. I am here to motivate you, goad you and to gently nudge you in
            that direction. It might sound complicated and time consuming in the beginning and trust me, you
            will want to give up. There are no short cuts here to success, no silver bullet to bite. I will
            help you along your journey to attain your wellness and fitness goals. I am not giving up on
            you. I am throwing down the fitness gauntlet. Are you willing to pick it up?</p>",
            'section_one_image'   => "assets/images/aboutImg.jpg",
            'section_two_heading' => "A Bit About Me",
            'section_two_content' => "p class='wow fadeInUp' data-wow-delay='0.5s'>I am Sanjana, a dreamer, a mother, a photographer,
            a pet parent to two lovely dogs, and a fitness fiend. It's been a little over a year since
            the fitness bug bit me and I have been reaping enormous benefits ever since.
            <p class='wow fadeInUp' data-wow-delay='0.5s'>While I am an academic and a Chartered Accountant
                by qualification, I have always wanted to be an entrepreneur.</p>
            <p class='wow fadeInUp' data-wow-delay='0.5s'>An anxiety survivor, fitness has played a major
                part in my transformation to a focused and a happy individual. More than anything else, it
                has spurred me on to found FitZen.Studio along with my trainer and good friend.</p>
            <p class='wow fadeInUp' data-wow-delay='0.5s'>My prior brush with personal training was in
                Singapore, where I lived for about 8 years. FitZen has now provided me the platform to
                pursue what I started there and spread the message of personal fitness.</p>",
            'section_two_image'   => "assets/images/about2.jpg"
        ]);
    }
}
