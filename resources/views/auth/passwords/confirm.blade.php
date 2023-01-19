@extends('layouts.app')

@section('title', 'Confirm Password')

@section('css')

@endsection

@section('content')

<div class="main-slider">
    <img class="img-fluid w-100" src="{{ asset('assets/images/loginBg.jpg')}}" alt="First slide">
    <div class="carousel-caption">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3 class="wow fadeInLeftBig" data-wow-delay="0.6s">Confirm Password</h3>
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
                <h6>{{ __('Please confirm your password before continuing.') }}</h6>
                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <div class="form-group">
                        <button class="loginBtn" type="submit">{{ __('Confirm Password') }}</button>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
