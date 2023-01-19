@extends('layouts.app')
@section('title', 'Contact-Us')

@section('css')
@endsection

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


    <section class="contactSec">
        <div class="container">

            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="title text-center mx-auto wow fadeInUp" data-wow-delay="0.4s">
                        <span>CONTACT US</span>
                        <h2>Contact Form</h2>
                    </div>
                    <form action="{{ url('contact-submit') }}" method="POST">
                        @csrf
                        <div class="contact-form mt-5">
                            <div class="row">
                                <div class="col-sm-6 input-field">
                                    <input type="text" name="first_name" id="" placeholder="First Name" maxlength="15"
                                           required>
                                </div>
                                <div class="col-sm-6 input-field">
                                    <input type="text" name="last_name" id="" placeholder="Last Name" maxlength="15"
                                           required>
                                </div>
                                <div class="col-sm-6 input-field">
                                    <input type="number" name="phone" id="" placeholder="Phone Number" required>
                                </div>
                                <div class="col-sm-6 input-field">
                                    <input type="email" name="email" id="" placeholder="Email" maxlength="35" required>
                                </div>
                                <div class="col-md-12 input-field">
                                    <textarea name="message" id="" cols="30" rows="10" placeholder="Message"
                                              maxlength="200" required></textarea>
                                </div>
                                <div class="col-md-12 ">
                                    <button type="submit" class="formBtn">Submit Now</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <section class="mapSection py-0">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-end align-items-end">
                <div class="col-lg-5">
                    <div class="infoWrap">
                        <span class="square"></span>
                        <div class="title wow fadeInUp" data-wow-delay="0.4s">
                            <span>{{ $content->section_heading }}<span class="line"></span></span>
                            <h2>{{ $content->section_sub_heading }}</h2>
                        </div>
                        <ul>
                            <li>
                                <a href="#">
                                    <strong>{{ $content->location_heading }}:</strong>
                                    <span><img src="{{ asset('assets/images/marker.png')}}" alt="">
                                    {{ $content->location }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="mailto:sanjana@fitzen.studio">
                                    <strong>{{ $content->email_heading }}:</strong>
                                    <span><img src="{{ asset('assets/images/envelope.png')}}" alt="">{{ $content->email }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="tel:+91-8248773982">
                                    <strong>{{ $content->phone_heading }}:</strong>
                                    <span><img src="{{ asset('assets/images/phone.png')}}" alt="">{{ $content->phone }}</span>
                                </a>
                            </li>
                        </ul>
                        <span class="circle"></span>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="map">
                        <iframe src="{{ $content->map }}" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('includes.instagram')

@endsection

@section('js')
@endsection
