@extends('layouts.app')
@section('title', 'Terms&Conditions')

@section('css')
@endsection

@section('content')
<div class="main-slider termsInner">
    <img class="img-fluid w-100" src="{{ asset($content->banner_image)}}" alt="First slide">
    <div class="carousel-caption">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="wow fadeInLeftBig" data-wow-delay="0.6s">{{$content->banner_heading}}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Main Slider -->



<section class="termsCondition">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title wow fadeInUp" data-wow-delay="0.4s">
                    <h2>{{ $content->section_heading }}</h2>
                </div>
                {!! $content->section_content !!}
            </div>
        </div>
    </div>
</section>
@include('includes.instagram')

@endsection

@section('js')
@endsection