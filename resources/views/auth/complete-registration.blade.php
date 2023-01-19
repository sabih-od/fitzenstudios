@extends('layouts.app')
@section('title', 'Register')
@section('content')

<div class="main-slider">
    <img class="img-fluid w-100" src="{{ asset('assets/images/loginBg.jpg')}}" alt="First slide">
    <div class="carousel-caption">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3 class="wow fadeInLeftBig" data-wow-delay="0.6s">Please Complete The Registration Process</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END: Main Slider -->


  <section class="loginModal">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6">
        @if($user != "")
        <form method="POST" action="{{ route('RegisterTrainer') }}">
            @csrf
            <input type = "hidden" value = "{{$user->password}}" name = "verification_token" />  
            <div class="form-group">
              <label for="username">Full name<span style="color: red">*</span></label>              
              <input id="name" type="text" class="form-control"  name="name" value="{{ $user->name }}" 
              required disabled >
              
            </div>
            <div class="form-group">
              <label for="emailAddress">Email Address<span style="color: red">*</span></label>
              <input type="email" class="form-control" name="email" id="register-email"  
                value="{{ $user->email }}" required disabled> 
             
            </div>
            
            <div class="form-group">
              <label for="password">Choose your Password<span style="color: red">*</span></label>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
           
            <div class="form-group">
              <button class="loginBtn" id="user_submit_btn" type="submit">Register</button>
            </div>
          </form>
          @else
          <div class="alert alert-danger alert-dismissible" role="alert">
            
            Token Not found
            </div>
        @endif
        </div>
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
<script>
  $(document).ready(function(){

    myFunction();
    var email           = 1;
    var phone           = 1;

    setTimeout(function () {
      $("span.alert").remove();
      }, 5000); // 5 secs
    
    var value = $("#register-phone").inputmask();

    
   
      function myFunction() {
        if(email == 0){
            $('#user_submit_btn').attr('disabled', true);
        }else{
            $('#user_submit_btn').attr('disabled', false);
        }
      }

    });

</script>
@endsection
