<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Create_homepage_cms_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\HomepageCMS::insert([
            'banner_heading' => "GET FIT WITH",
            'banner_sub_heading' => "Fitzen.Studio",
            'banner_content' => "We have rebranded from FitMonk.Studio to Fitzen.Studio!",
            'banner_image' => "assets/images/slider1.jpg",
            'about_heading' => "ABOUT US",
            'about_sub_heading' => "Fitzen.Studio",
            'about_content' => "  <p class='wow fadeInUp' data-wow-delay='0.5s'>We are fitness trainers, motivators and influencers,
            specialising in providing bespoke training programmes for each individuals or groups. Our
            programme delivery is both offline (in-person) as well as online. Browse the site to get to know
            us better.</p>",
            'about_image' => "assets/images/aboutImg.jpg",
            'categories_heading' => "FEATURED CATEGORIES",
            'categories_sub_heading' => "Fitzen.Studio",
            'categories_content_one' => " <h3>Kick-Boxing<span>Power & Precision</span></h3>",
            'categories_image_one' => "assets/images/img1.jpg",
            'categories_content_two' => " <h3>Personal Training<span>Look Good, Feel Good</span></h3>",
            'categories_image_two' => "assets/images/img2.jpg",
            'categories_content_three' => "<h3>Muscle Building<span>A Healthier You</span></h3>",
            'categories_image_three' => "assets/images/img3.jpg",
            'categories_content_four' => " <h3>Group Fitness<span>Strength & Stamina</span></h3>",
            'categories_image_four' => "assets/images/img4.jpg",
            'categories_content_five' => "<h3>Boxing<span>Protect yourself</span></h3>",
            'categories_image_five' => "assets/images/img5.jpg",
            'categories_content_six' => " <h3>Cardio Fitness<span>Strength & Stamina</span></h3>",
            'categories_image_six' => "assets/images/img6.jpg",
            'workout_heading' => "FEATURED WORKOUT TIPS",
            'workout_sub_heading' => "Fitzen.Studio",
            'workout_image_one' => "assets/images/video.jpg",
            'workout_url_one' => "https://youtu.be/nWwpyclIEu4",
            'workout_image_two' => "assets/images/video.jpg",
            'workout_url_two' => "https://youtu.be/nWwpyclIEu4",
            'workout_image_three' => "assets/images/video.jpg",
            'workout_url_three' => "https://youtu.be/nWwpyclIEu4",
            'workout_image_four' => "assets/images/video.jpg",
            'workout_url_four' => "https://youtu.be/nWwpyclIEu4",
            'testimonial_heading' => "OUR TESTIMONIAL",
            'testimonial_sub_heading' => "Fitzen.Studio",
            'testimonial_content_one' => "<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum nt here, content here', making it look like readable English.</p>",
            "testimonial_author_one" => 'Jashon Smith',
            "testimonial_author_two" => 'John Eric',
            "testimonial_author_three" => 'Sarah Jason',
            'testimonial_content_two' => "<p>It is a long established fact that a reader will be distracted by the readable content of
            a page when looking at its layout. The point of using Lorem Ipsum nt here, content
            here', making it look like readable English.</p>",
            'testimonial_content_three' => "  <p>It is a long established fact that a reader will be distracted by the readable content of
            a page when looking at its layout. The point of using Lorem Ipsum nt here, content
            here', making it look like readable English.</p>",
            'gallery_image_one' => "assets/images/insta1.jpg",
            'gallery_image_two' => "assets/images/insta2.jpg",
            'gallery_image_three' => "assets/images/insta3.jpg",
            'gallery_image_four' => "assets/images/insta4.jpg",
            'gallery_image_five' => "assets/images/insta5.jpg",
        ]);
    }
}
