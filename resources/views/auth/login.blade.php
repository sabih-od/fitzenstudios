@extends('layouts.app')
@section('title')
Login
@endsection
@section('content')

@php $content = App\Models\LoginCms::find(1); @endphp
<div class="main-slider">
    <img class="img-fluid w-100" src="{{ $content->banner_image ? asset($content->banner_image) : asset('assets/images/loginBg.jpg')}}" alt="First slide">
    <div class="carousel-caption">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3 class="wow fadeInLeftBig" data-wow-delay="0.6s">{{$content->banner_text}}</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END: Main Slider -->

  <section class="loginModal" id="login">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6">
          <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="emailAddress">Email Address *</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            </div>
            <div class="form-group">
              <label for="password">Password *</label>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
              <a class="forgetPass" href="{{ route('forgot_password') }}">
                  {{ __('Forgot Your Password?') }}
              </a>
              {{-- <input type="password" name="password" placeholder="Password" class="form-control"> --}}
            </div>
            <div class="form-group">
              <button class="loginBtn" type="submit">LOGIN</button>
            </div>
          </form>
          <a href="{{ url('register') }}" class="reqLink">or
            Register</a>
          <p>or use a social network</p>

          {{-- <ul class="list-unstyled socialIo">
            <li><a href="#" class="fb" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="#" class="insta" target="_blank"><i class="fab fa-instagram"></i></a></li>
            <li><a href="#" class="google" target="_blank"><i class="fab fa-google-plus-g"></i></a></li>
          </ul> --}}
        </div>
      </div>
    </div>
  </section>
@include('includes.instagram')

@endsection
