@extends('layouts.trainer')
@section('page-title')
Edit Profile
@endsection
@section('content')
<div class="content-wrap">
    <div class="row">
        {{-- <div class="col-md-8">
            <nav class="users-tab wow fadeInUp" data-wow-delay="0.9s">
                <ul class="nav nav-pills" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="one-tab" data-toggle="tab" href="#one-pane" role="tab" aria-controls="one-pane" aria-selected="true">Trainer Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="two-tab" data-toggle="tab" href="#two-pane" role="tab" aria-controls="two-pane" aria-selected="false">Trainer schedules</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" id="three-tab" data-toggle="tab" href="#three-pane" role="tab" aria-controls="three-pane" aria-selected="false">Performance details</a>
                    </li> -->
                </ul>
            </nav>
        </div> --}}
        <div class="col-md-12">

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="one-pane" role="tabpanel" aria-labelledby="one-tab">
                    <div class="profile-wrap">
                        <div class="profileInfo">
                            <div class="profileImg">
                                <figure>

                                    <img src="{{ $trainer->photo ?  asset($trainer->photo)  : asset('assets/images/profileImg.jpg') }}" class="rounded-circle img-fluid" alt="img">
                                </figure>
                            </div>
                            <div class="profileContent">
                                <h3>{{ ucfirst($trainer->name) .' '. ucfirst($trainer->last_name) }}</h3>
                                <h4>Trainer</h4>
                                <p>{{ $trainer->description }}</p>
                            </div>
                        </div>
                        <div class="d-flex mb-4 justify-content-between align-items-center">
                            <h3 class="m-0">Personal Information</h3>

                        </div>

                        <form action="{{ url('trainer/ProfileUpdate') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="trainer_id" value="{{ $trainer->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">First Name</label>
                                        <input type="text" name="name" value="{{ $trainer->name }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Last Name</label>
                                        <input type="text" name="last_name" value="{{ $trainer->last_name }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input disabled type="email" name="email" value="{{ $trainer->email }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Phone</label>
                                        <input type="number" name="phone" value="{{ @$trainer->phone ?? ' ' }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Gender</label>
                                        @if(@$trainer->gender == "Female")
                                            <input type="radio" name="gender" value="Male"   > Male
                                            <input type="radio" name="gender" value="Female"  checked > Female
                                        @else
                                            <input type="radio" name="gender" value="Male"  checked> Male
                                            <input type="radio" name="gender" value="Female"> Female
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Date Of Brith</label>
                                        <input type="date" name="dob" value="{{ date('Y-m-d' , strtotime($trainer->dob)) }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Age</label>
                                        <input type="number" name="age" value="{{ $trainer->age ?? ' ' }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Weight</label>
                                        <input type="text" name="weight" value="{{ $trainer->weight ?? ' ' }}" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Nationality</label>
                                        <input type="text" name="nationality" value="{{ $trainer->nationality ?? ' ' }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Country of Residence</label>
                                        <input type="text" name="country" value="{{ $trainer->country ?? ' ' }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">City</label>
                                        <input type="text" value="{{ $trainer->city ?? ' ' }}" class="form-control" name="city">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Time Zone</label>
                                        <select name="time_zone" id="time_zone" class="form-control">
                                            <option value="" selected disabled>Select Time Zone</option>
                                            @if(count($timezones) > 0)
                                            @foreach ($timezones as $timezone)
                                                <option value="{{ $timezone->id }}" {{ old('time_zone', isset($trainer) ? $trainer->time_zone : '') == $timezone->id ? 'selected' : '' }}>{{ $timezone->abbreviation }}</option>
                                            @endforeach
                                                @endif
                                        </select>
                                        <!--<input type="text" name="time_zone" value="{{ $trainer->time_zone ?? ' ' }}" class="form-control">-->
                                    </div>
                                </div>
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>Days Available <span id="selectedId"></span></label>--}}
{{--                                        <select id="selecteddays" multiple name="days_available[]">--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="">No. of Sessions in a Week</label>--}}
{{--                                        <input type="text" name="no_of_session_in_week" value="{{ $trainer->no_of_session_in_week }}" class="form-control">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="description" class="form-control" >{{ $trainer->description ?? ' '}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="photo">Profile Picture</label>
                                        <input type="file" name="photo" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @if($trainer->photo)
                                        <img src="{{ asset($trainer->photo) }}" width="250px" height="auto" alt="">
                                    @endif
                                </div>
                            </div>
                            <button type="submit" href="#" class="btnStyle">Update Profile</button>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="two-pane" role="tabpanel" aria-labelledby="two-tab">
                    <h2 class="trainerHead">Trainer Schedules</h2>
                    <div class="row">
                        <div class="col-md-12">
                                <div class="performCard">
                                    <div class="dateWrap">
                                        <h2>12<span>MARCH</span></h2>
                                    </div>
                                    <h3><span>Full Name</span>Cardio Session</h3>
                                    <h3><span>Customer Name</span>James Olivia</h3>
                                    <h3><span>Trainer Name</span>John Smith</h3>
                                    <h3><span>Time</span>10:00AM-12:00PM</h3>
                                    <h3><span>Status</span>Schedule</h3>
                                    <a href="performance-details.php" class="btnStyle">VIEW DETAILS</a>
                                </div>
                                <div class="performCard">
                                    <div class="dateWrap">
                                        <h2>12<span>MARCH</span></h2>
                                    </div>
                                    <h3><span>Full Name</span>Cardio Session</h3>
                                    <h3><span>Customer Name</span>James Olivia</h3>
                                    <h3><span>Trainer Name</span>John Smith</h3>
                                    <h3><span>Time</span>10:00AM-12:00PM</h3>
                                    <h3><span>Status</span>Schedule</h3>
                                    <a href="performance-details.php" class="btnStyle">VIEW DETAILS</a>
                                </div>
                                <div class="performCard">
                                    <div class="dateWrap">
                                        <h2>12<span>MARCH</span></h2>
                                    </div>
                                    <h3><span>Full Name</span>Cardio Session</h3>
                                    <h3><span>Customer Name</span>James Olivia</h3>
                                    <h3><span>Trainer Name</span>John Smith</h3>
                                    <h3><span>Time</span>10:00AM-12:00PM</h3>
                                    <h3><span>Status</span>Schedule</h3>
                                    <a href="performance-details.php" class="btnStyle">VIEW DETAILS</a>
                                </div>
                                <div class="performCard">
                                    <div class="dateWrap">
                                        <h2>12<span>MARCH</span></h2>
                                    </div>
                                    <h3><span>Full Name</span>Cardio Session</h3>
                                    <h3><span>Customer Name</span>James Olivia</h3>
                                    <h3><span>Trainer Name</span>John Smith</h3>
                                    <h3><span>Time</span>10:00AM-12:00PM</h3>
                                    <h3><span>Status</span>Schedule</h3>
                                    <a href="performance-details.php" class="btnStyle">VIEW DETAILS</a>
                                </div>
                                <div class="performCard">
                                    <div class="dateWrap">
                                        <h2>12<span>MARCH</span></h2>
                                    </div>
                                    <h3><span>Full Name</span>Cardio Session</h3>
                                    <h3><span>Customer Name</span>James Olivia</h3>
                                    <h3><span>Trainer Name</span>John Smith</h3>
                                    <h3><span>Time</span>10:00AM-12:00PM</h3>
                                    <h3><span>Status</span>Schedule</h3>
                                    <a href="performance-details.php" class="btnStyle">VIEW DETAILS</a>
                                </div>
                                <div class="performCard">
                                    <div class="dateWrap">
                                        <h2>12<span>MARCH</span></h2>
                                    </div>
                                    <h3><span>Full Name</span>Cardio Session</h3>
                                    <h3><span>Customer Name</span>James Olivia</h3>
                                    <h3><span>Trainer Name</span>John Smith</h3>
                                    <h3><span>Time</span>10:00AM-12:00PM</h3>
                                    <h3><span>Status</span>Schedule</h3>
                                    <a href="performance-details.php" class="btnStyle">VIEW DETAILS</a>
                                </div>
                                <div class="performCard">
                                    <div class="dateWrap">
                                        <h2>12<span>MARCH</span></h2>
                                    </div>
                                    <h3><span>Full Name</span>Cardio Session</h3>
                                    <h3><span>Customer Name</span>James Olivia</h3>
                                    <h3><span>Trainer Name</span>John Smith</h3>
                                    <h3><span>Time</span>10:00AM-12:00PM</h3>
                                    <h3><span>Status</span>Schedule</h3>
                                    <a href="performance-details.php" class="btnStyle">VIEW DETAILS</a>
                                </div>
                                <div class="performCard">
                                    <div class="dateWrap">
                                        <h2>12<span>MARCH</span></h2>
                                    </div>
                                    <h3><span>Full Name</span>Cardio Session</h3>
                                    <h3><span>Customer Name</span>James Olivia</h3>
                                    <h3><span>Trainer Name</span>John Smith</h3>
                                    <h3><span>Time</span>10:00AM-12:00PM</h3>
                                    <h3><span>Status</span>Schedule</h3>
                                    <a href="performance-details.php" class="btnStyle">VIEW DETAILS</a>
                                </div>
                                <div class="performCard">
                                    <div class="dateWrap">
                                        <h2>12<span>MARCH</span></h2>
                                    </div>
                                    <h3><span>Full Name</span>Cardio Session</h3>
                                    <h3><span>Customer Name</span>James Olivia</h3>
                                    <h3><span>Trainer Name</span>John Smith</h3>
                                    <h3><span>Time</span>10:00AM-12:00PM</h3>
                                    <h3><span>Status</span>Schedule</h3>
                                    <a href="performance-details.php" class="btnStyle">VIEW DETAILS</a>
                                </div>
                                <div class="performCard">
                                    <div class="dateWrap">
                                        <h2>12<span>MARCH</span></h2>
                                    </div>
                                    <h3><span>Full Name</span>Cardio Session</h3>
                                    <h3><span>Customer Name</span>James Olivia</h3>
                                    <h3><span>Trainer Name</span>John Smith</h3>
                                    <h3><span>Time</span>10:00AM-12:00PM</h3>
                                    <h3><span>Status</span>Schedule</h3>
                                    <a href="performance-details.php" class="btnStyle">VIEW DETAILS</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
