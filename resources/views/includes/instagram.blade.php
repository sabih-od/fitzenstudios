
@php 
     $content = App\Models\HomepageCMS::find(1);
@endphp
<section class="instaSec p-0 wow fadeInUp" data-wow-delay="0.4s">
    <div class="container-fluid px-0">
        <div class="row no-gutters">
            <div class="col-md-12">
                <div class="instaSlider">
                    <div class="instaCard wow fadeInUp" data-wow-delay="0.3s">
                        <img src="{{ asset($content->gallery_image_one)}}" alt="instagram" class="img-fluid">
                        <div class="content">
                            <a href="#"><img src="{{ asset('assets/images/instaLogo.png')}}" alt=""></a>
                        </div>
                    </div>
                    <div class="instaCard wow fadeInUp" data-wow-delay="0.4">
                        <img src="{{ asset($content->gallery_image_two)}}" alt="instagram" class="img-fluid">
                        <div class="content">
                            <a href="#"><img src="{{ asset('assets/images/instaLogo.png')}}" alt=""></a>
                        </div>
                    </div>
                    <div class="instaCard wow fadeInUp" data-wow-delay="0.5s">
                        <img src="{{ asset($content->gallery_image_three)}}" alt="instagram" class="img-fluid">
                        <div class="content">
                            <a href="#"><img src="{{asset('assets/images/instaLogo.png')}}" alt=""></a>
                        </div>
                    </div>
                    <div class="instaCard wow fadeInUp" data-wow-delay="0.6s">
                        <img src="{{asset($content->gallery_image_four)}}" alt="instagram" class="img-fluid">
                        <div class="content">
                            <a href="#"><img src="{{asset('assets/images/instaLogo.png')}}" alt=""></a>
                        </div>
                    </div>
                    <div class="instaCard wow fadeInUp" data-wow-delay="0.8s">
                        <img src="{{asset($content->gallery_image_five)}}" alt="instagram" class="img-fluid">
                        <div class="content">
                            <a href="#"><img src="{{asset('assets/images/instaLogo.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>