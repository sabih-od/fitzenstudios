@extends('layouts.app')
@section('title', 'Thank you for Registration')

@section('content')
<div class="main-slider">
    <img class="img-fluid w-100" src="{{ asset('assets/images/loginBg.jpg')}}" alt="First slide">
    <div class="carousel-caption">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3 class="wow fadeInLeftBig" data-wow-delay="0.6s">Thank you for Registration</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END: Main Slider -->

  <section class="loginModal">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
        @if(Auth::check())
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
              Thank you for showing interest in Fitzen Studios.<br />
              We have sent you an email on your email address. please proceed from there
            </div>
            @endif
        </div>
    </div>
    </div>
</section>


@endsection