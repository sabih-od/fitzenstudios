@extends('layouts.customer')
@section('page-title')
User Profile
@endsection

@section('content')
<div class="content-wrap">
    <div class="row">
        <div class="col-md-12">
            <h2 class="secHeading">Edit User Profile</h2>
        </div>
        <div class="col-md-12">
            <div class="profile-wrap">
            <form method="POST" action="{{route('ProfileUpdate')}}" enctype="multipart/form-data">
                    @csrf
                <div class="profileInfo">
                    <div class="profileImg">
                        <figure>
                        @if(isset($customer->photo))
                            <img src="{{ asset('uploads/images/customer/'.$customer->photo) }}" class="rounded-circle img-fluid" alt="img">
                            @else
                            <img src="{{ asset('themes/customer/assets/images/default-user.jpg') }}" class="rounded-circle img-fluid" alt="img">
                            @endif
                            <div class="filSet">
                                <span><i class="fas fa-camera"></i><input type="file" name = "photo"></span>
                            </div>
                        </figure>
                    </div>
                    <div class="profileContent">
                        <h3>{{$customer->first_name}}  {{$customer->last_name}}</h3>
                        <h4>User</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
                    </div>
                </div>
                <div class="d-flex mb-4 justify-content-between align-items-center">
                    <h3 class="m-0">Personal Information</h3>
                </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">First Name</label>
                                <input type="text" name="first_name" value="{{$customer->first_name}}" class="form-control" required >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <input type="text" name="last_name" value="{{$customer->last_name}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" value="{{$customer->email}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="text" name="phone" value="{{$customer->phone}}" class="form-control" required >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Gender</label>
                                <select name="gender" class="form-control">
                                    <option value = "Male" {{ ( $customer->gender == "Male") ? 'selected' : '' }}>Male</option>
                                    <option value = "Female" {{ ( $customer->gender == "Female") ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Date Of Brith</label>
                                <input type="text" name="dob" value="{{$customer->dob}}" class="form-control" id="dob" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Age</label>
                                <input type="text" name="age" value="{{$customer->age}}" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Weight</label>
                                <input type="text" name="weight" value="{{$customer->weight}}" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nationality</label>
                                <input type="text" name="nationality" value="{{$customer->nationality}}" class="form-control"  placeholder="USA" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Country of Residence</label>
                                <input type="text" name="residence" value="{{$customer->residence}}" class="form-control" placeholder="USA" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">City</label>
                                <input type="text" name="city" value="{{$customer->city}}" class="form-control" placeholder="New York" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Time Zone</label>
                                <input type="text" name="timezone" value="{{$customer->timezone}}" class="form-control" placeholder="GMT-4">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Days:</label>
                                <input type = "hidden" name = "days" id="selectedId" value = "{{$customer->days}}">
                                <select id="selecteddays" multiple></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">No. of Sessions in a Week</label>
                                <input type="text" name="sessions_in_week" value="{{$customer->sessions_in_week}}" class="form-control" placeholder="10" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Type of Training </label>
                                <input type="text" name="training_type" value="{{$customer->training_type}}" class="form-control" placeholder="Weight Loss" >
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                            <button class="btnStyle" type = "submit">UPDATE PROFILE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type = "text/javascript">

    $(document).ready(function () {
         $('#dob').datepicker({
         format: 'mm/dd/yyyy',
         todayBtn: 'linked',
         todayHighlight: true,
         autoclose: true,
       });

       $('#selecteddays').val([{{$customer->days}}]);
       $('#selecteddays').trigger('change');

    });
  </script>
@endsection
