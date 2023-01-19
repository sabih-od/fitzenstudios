@extends('layouts.app')
@section('css')
@endsection
@section('title', 'Home')
@section('content')


    {{-- commeneint for testing --}}
    <div class="main-slider">
        <img class="img-fluid w-100" src="{{ asset($content->banner_image)}}" alt="First slide">
        <div class="carousel-caption">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="wow fadeInLeftBig" data-wow-delay="0.5s">{{ $content->banner_heading }}</h2>
                        <h3 class="wow fadeInLeftBig" data-wow-delay="0.6s">{{ $content->banner_sub_heading }}</h3>
                        <p class="wow fadeInLeftBig" data-wow-delay="0.7s">{!! $content->banner_content !!}</p>
                        {{--                        <a href="{{ url('book-demo')}}" class="themeBtn wow fadeInLeftBig" data-wow-delay="0.8s">--}}
                        {{--                            <span></span>GET A QUOTE--}}
                        {{--                        </a>--}}
                    </div>
                </div>
            </div>
        </div>
        {{--        <a href="javascript:void(0)" class="scroll-down goDown" id="scroll-down"><small>SCROLL DOWN TO--}}
        {{--                DISCOVER</small><span></span></a>--}}
    </div>
    <!-- END: Main Slider -->

    <section class="aboutSec">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <figure class="aboutImg wow fadeInLeft" data-wow-delay="0.5s">
                        <img src="{{ asset($content->about_image)}}" alt="">
                    </figure>
                </div>
                <div class="col-md-5">
                    <div class="title wow fadeInUp" data-wow-delay="0.4s">
                        <span>{{ $content->about_heading ?? " " }} <span class="line"></span></span>
                        <h2>{{ $content->about_sub_heading ?? " " }}</h2>
                    </div>
                    {!! $content->about_content !!}
                    {{-- <p class="wow fadeInUp" data-wow-delay="0.5s">{{ $content->banner_heading }}</p> --}}
                    <a href="{{ url('about-us')}}" class="themeBtn wow fadeInUp" data-wow-delay="0.6s"><span></span>LEARN
                        MORE</a>
                </div>
            </div>
        </div>
    </section>

    <section class="featuredSec">
        <div class="container-fluid px-0">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="title text-center mx-auto wow fadeInUp" data-wow-delay="0.4s">
                        <span>{{ $content->categories_heading ?? " " }}</span>
                        <h2>{{ $content->categories_sub_heading ?? " " }}</h2>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="featureCard wow fadeInUp" data-wow-delay="0.3s">
                        <img src="{{ asset($content->categories_image_one) }}" alt="featured">
                        <div class="content">
                            {{-- <h3>Kick-Boxing<span>Power & Precision</span></h3> --}}
                            {!! $content->categories_content_one ?? " " !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="featureCard wow fadeInUp" data-wow-delay="0.4s">
                        <img src="{{ asset($content->categories_image_two) }}" alt="featured">
                        <div class="content">
                            {!! $content->categories_content_two ?? " " !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="featureCard wow fadeInUp" data-wow-delay="0.5s">
                        <img src="{{ asset($content->categories_image_three) }}" alt="featured">
                        <div class="content">
                            {!! $content->categories_content_three ?? " " !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="featureCard wow fadeInUp" data-wow-delay="0.6s">
                        <img src="{{ asset($content->categories_image_four)}}" alt="featured">
                        <div class="content">
                            {!! $content->categories_content_four ?? " " !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="featureCard wow fadeInUp" data-wow-delay="0.7s">
                        <img src="{{ asset($content->categories_image_five)}}" alt="featured">
                        <div class="content">
                            {!! $content->categories_content_five ?? " " !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="featureCard wow fadeInUp" data-wow-delay="0.8s">
                        <img src="{{ asset($content->categories_image_six)}}" alt="featured">
                        <div class="content">
                            {!! $content->categories_content_six ?? " " !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="workTipSec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title text-center mx-auto wow fadeInUp" data-wow-delay="0.4s">
                        <span>{{ $content->workout_heading ?? " " }}</span>
                        <h2>{{ $content->workout_sub_heading ?? " " }}</h2>
                    </div>
                </div>
                <div class="col-lg-12 px-0">
                    <div class="swiper workTipsSlider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="videoThumb wow fadeInUp" data-wow-delay="0.6s">
                                    <img src="{{ asset($content->workout_image_one)}}" class="w-100"/>
                                    <a class="playVid" data-fancybox href="{{ $content->workout_url_one ?? " " }}">
                                        <i class="fas fa-play"></i>
                                        <span>watch Now</span>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="videoThumb wow fadeInUp" data-wow-delay="0.6s">
                                    <img src="{{ asset($content->workout_image_two)}}" class="w-100"/>
                                    <a class="playVid" data-fancybox href="{{ $content->workout_url_two ?? " " }}">
                                        <i class="fas fa-play"></i>
                                        <span>watch Now</span>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="videoThumb wow fadeInUp" data-wow-delay="0.6s">
                                    <img src="{{ asset($content->workout_image_three)}}" class="w-100"/>
                                    <a class="playVid" data-fancybox href="{{ $content->workout_url_three ?? " " }}">
                                        <i class="fas fa-play"></i>
                                        <span>watch Now</span>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="videoThumb wow fadeInUp" data-wow-delay="0.6s">
                                    <img src="{{ asset($content->workout_image_four)}}" class="w-100"/>
                                    <a class="playVid" data-fancybox href="{{ $content->workout_url_four ?? " " }}">
                                        <i class="fas fa-play"></i>
                                        <span>watch Now</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- START: Testimonials Section  -->
    <section class="testimonialSec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title text-center mx-auto wow fadeInUp" data-wow-delay="0.4s">
                        <span>{{ $content->testimonial_heading ?? " " }}</span>
                        <h2>{{ $content->testimonial_sub_heading ?? " " }}</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="testimonialCarousel">
                        <div class="testimonialCard wow fadeInUp" data-wow-delay="0.3s">
                            <span class="text-left"><i class="fas fa-quote-left"></i></span>
                            {!! $content->testimonial_content_one  ?? " " !!}
                            <span class="text-right"><i class="fas fa-quote-right"></i></span>
                            <h3>{{ $content->testimonial_author_one ?? " " }}</h3>
                            <div class="rating">
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                            </div>
                        </div>

                        <div class="testimonialCard wow fadeInUp" data-wow-delay="0.4s">
                            <span class="text-left"><i class="fas fa-quote-left"></i></span>
                            {!! $content->testimonial_content_two ?? " " !!}
                            <span class="text-right"><i class="fas fa-quote-right"></i></span>
                            <h3>{{ $content->testimonial_author_two ?? " " }}</h3>
                            <div class="rating">
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                            </div>
                        </div>

                        <div class="testimonialCard wow fadeInUp" data-wow-delay="0.5s">
                            <span class="text-left"><i class="fas fa-quote-left"></i></span>
                            {!! $content->testimonial_content_three ?? " " !!}
                            <span class="text-right"><i class="fas fa-quote-right"></i></span>
                            <h3>{{ $content->testimonial_author_three ?? " " }}</h3>
                            <div class="rating">
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                            </div>
                        </div>


                        <div class="testimonialCard wow fadeInUp" data-wow-delay="0.6s">
                            <span class="text-left"><i class="fas fa-quote-left"></i></span>
                            {!! $content->testimonial_content_two ?? " " !!}
                            <span class="text-right"><i class="fas fa-quote-right"></i></span>
                            <h3>{{ $content->testimonial_author_two ?? " " }}</h3>
                            <div class="rating">
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END: Testimonials Section  -->
    @include('includes.instagram')
@endsection

@section('js')
@endsection
