@extends('layouts.app')
@section('title', 'Register')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('build/css/intlTelInput.css') }}">
<link rel="stylesheet" href="{{ asset('build/css/demo.css') }}">
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    .iti--allow-dropdown {
        width: 100% !important;
    }

</style>
@endsection
@section('content')
@php $content = App\Models\SignupCms::find(1); @endphp
<div class="main-slider">
    <img class="img-fluid w-100"
        src="{{ $content->banner_image ? asset($content->banner_image) : asset('assets/images/loginBg.jpg')}}"
        alt="First slide">
    <div class="carousel-caption">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="wow fadeInLeftBig" data-wow-delay="0.6s">{{ $content->banner_text }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Main Slider -->
@php $timezones = App\Models\TimeZone::all(); @endphp

<section class="loginModal registerModal" id="signUp">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-2 col-md-2"></div>

            <div class="col-lg-8 col-md-8">
                <div class="container-fluid">
                    <form method="POST" class="row" action="{{ route('register') }}">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">First name<span style="color: red">*</span></label>
                                <input id="f_name" type="text"
                                    class="form-control @error('f_name') is-invalid @enderror" name="f_name"
                                    value="{{ old('f_name') }}" required autocomplete="f_name" autofocus
                                    placeholder="First Name">
                                @error('f_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Last Name<span style="color: red">*</span></label>
                                <input id="l_name" type="text"
                                    class="form-control @error('l_name') is-invalid @enderror" name="l_name"
                                    value="{{ old('l_name') }}" required autocomplete="l_name" autofocus
                                    placeholder="Last Name">
                                @error('l_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emailAddress">Email Address<span style="color: red">*</span></label>
                                <input type="email" maxlength="30"
                                    class="form-control  @error('email') is-invalid @enderror" name="email"
                                    id="register-email" aria-describedby="register-email" value="{{ old('email') }}"
                                    placeholder="your email" required>
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password<span style="color: red">*</span></label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="message" class="form-control" rows="4" cols="50"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="timezone">Time Zone</label>
                                <select name="time_zone" id="time_zone" required class=" form-control">
                                    <option value="">Select Time Zone</option>
                                    @forelse ($timezones as $time)
                                    
                                    {{--<option value="{{ $time->timezone_value }}">
                                        {{ $time->zone_name.' '.$time->time_zone }}</option>--}}
                                        
                                    <option value="{{ $time->id}}">
                                        {{ $time->zone_name.' '.$time->time_zone }}</option>
                                    @empty

                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="display:block;" for="phone">Phone<span
                                        style=" color: red">*</span></label>
                                {{-- <input type="text" class="form-control"> --}}
                                <input type="tel" name="phone" class="form-control" required id="phone"
                                    style="width: 100% !important">
                                {{-- <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                        id="register-phone" data-inputmask="'mask': '(999) 999-9999'" placeholder="(123) 123-1234"
                                        aria-describedby="register-phone" maxlength="15"
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        required> --}}

                                @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" style="width: 15px;" name="accept_terms" required><span
                                        class="ml-2"> Accept Terms & Conditions</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group w-100">
                                <button class="loginBtn" id="user_submit_btn" type="submit">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-2 col-md-2"></div>

        </div>
    </div>
</section>
@include('includes.instagram')

@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>


<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('build/js/intlTelInput.js')}}"></script>
<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {

        utilsScript: "{{ asset('build/js/utils.js')}}",
    });

    $(document).ready(function () {


        $('.js-example-basic-single').select2();

        myFunction();
        var email = 1;
        var phone = 1;

        setTimeout(function () {
            $("span.alert").remove();
        }, 5000); // 5 secs

        var value = $("#register-phone").inputmask();

        var validateEmail = function (elementValue) {
            var emailPattern = /^(?!.*(?:''|\.\.))[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            return emailPattern.test(elementValue);
        }

        $('#register-email').blur(function () {

            var value = $(this).val();
            var valid = validateEmail(value);

            if (!valid) {
                email = 0;
                $(this).css('color', 'red');
                $('#register-email').css('border', '1px solid rgb(249 119 119)');

                myFunction();

            } else {
                email = 1;
                $(this).css('color', '');
                $('#register-email').css('border', '1px solid rgb(51 119 255)');
                myFunction();
            }
        });

        $('#register-email').keyup(function () {

            var value = $(this).val();
            if (value.indexOf(' ') >= 0) {
                email = 0;
                myFunction();

                $('#emailspaceerrormessage').css('color', 'red');
                $('#emailspaceerrormessage').html('White space not allowed').css("color",
                    "rgb(247 12 12)");
                $(this).css('color', 'red');
                $('#register-email').css('border', '1px solid rgb(249 119 119)');
                var valid = validateEmail(value);
                return;
            }
            var valid = validateEmail(value);

            if (!valid) {
                email = 0;
                $(this).css('color', 'red');
                $('#emailspaceerrormessage').html('');

                $('#register-email').css('border', '1px solid rgb(249 119 119)');

                myFunction();

            } else {
                email = 1;
                $(this).css('color', '');
                $('#emailspaceerrormessage').html('');

                $('#register-email').css('border', '1px solid rgb(51 119 255)');
                myFunction();

            }
        });

        function myFunction() {
            if (email == 0) {
                $('#user_submit_btn').attr('disabled', true);
            } else {
                $('#user_submit_btn').attr('disabled', false);
            }
        }

    });

</script>
@endsection
