@extends('layouts.admin')
@section('page-title')
Change Password
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
    <div class="card">        
        <div class="card-body">
            <form method="POST" action="">
                @csrf 
                <input type="hidden" name="email" value = "admin@admin.com" >
                <div class="form-group">
                    <label for="email" >{{ __('Current Password') }}</label>                           
                    <input id="old_password" type="password" class="form-control @error('password') is-invalid @enderror" name="old_password" required autocomplete="new-password">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror                          
                </div>

                <div class="form-group" >
                    <label for="password" >{{ __('New Password') }}</label>                            
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror                           
                </div>
                <div class="form-group ">
                    <label for="password-confirm" >{{ __('Confirm Password') }}</label>                           
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">                           
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
@endsection
