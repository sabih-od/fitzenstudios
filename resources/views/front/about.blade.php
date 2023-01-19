@extends('layouts.app')
@section('css')
@endsection
@section('title', 'About-Us')


@section('content')
<div class="main-slider">
    <img class="img-fluid w-100" src="{{ asset($content->banner_image)}}" alt="First slide">
    <div class="carousel-caption">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="wow fadeInLeftBig" data-wow-delay="0.6s">{{ $content->banner_heading }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Main Slider -->

<section class="aboutSec aboutInner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <figure class="aboutImg wow fadeInLeft" data-wow-delay="0.5s">
                    <img src="{{ asset($content->section_one_image)}}" alt="">
                </figure>
            </div>
            <div class="col-lg-6">
                <div class="title wow fadeInUp" data-wow-delay="0.4s">
                    <h3>{{ $content->section_one_heading }}</h3>
                </div>
                {!! $content->section_one_content !!}
            </div>
            <div class="col-md-12 text-center pt-4">
                {!! $content->section_one_extra_content !!}
                <a href="#" class="themeBtn wow fadeInUp" data-wow-delay="0.86s"><span></span>GET IN TOUCH</a>
            </div>
        </div>
    </div>
</section>

<section class="aboutInnerMe">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="title wow fadeInUp" data-wow-delay="0.4s">
                    <h3>{{ $content->section_two_heading }}</h3>
                </div>
                {!! $content->section_two_content !!}
            </div>
            <div class="col-lg-6">
                <figure class="aboutMe wow fadeInLeft" data-wow-delay="0.5s">
                    <img src="{{ asset($content->section_two_image)}}" alt="">
                </figure>
            </div>
        </div>
    </div>
</section>
@include('includes.instagram')
@endsection

@section('js')
@endsection
