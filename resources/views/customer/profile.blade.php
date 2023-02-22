@extends('layouts.customer')
@section('page-title')
    User Profile
@endsection

@section('content')
    <div class="content-wrap">
        <div class="row">
            <div class="col-md-12">
                <h2 class="secHeading">User Profile</h2>
            </div>
            <div class="col-md-12">
                <div class="profile-wrap">
                    <div class="profileInfo">
                        <div class="profileImg">
                            <figure>
                                @if(isset($customer->photo))
                                    <img src="{{ asset($customer->photo) }}" class="rounded-circle img-fluid" alt="img">
                                @else
                                    <img src="{{ asset('themes/customer/assets/images/default-user.jpg') }}"
                                         class="rounded-circle img-fluid" alt="img">
                                @endif

                            </figure>
                        </div>
                        <div class="profileContent">
                            <h3>{{$customer->first_name}}  {{$customer->last_name}}</h3>
                            <h4>User</h4>
                            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p> --}}
                        </div>
                    </div>
                    <div class="d-flex mb-4 justify-content-between align-items-center">
                        <h3 class="m-0">Personal Information</h3>
                        {{-- <a href="{{ url('customer/profile-edit') }}" class="editBtn">EDIT PROFILE</a> --}}
                    </div>

                    <form action="{{ url('customer/ProfileUpdate') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">First Name</label>
                                    <input type="text" value="{{$customer->first_name}}" class="form-control"
                                           name="first_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Last Name</label>
                                    <input type="text" value="{{$customer->last_name}}" class="form-control"
                                           name="last_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" value="{{$customer->email}}" class="form-control" name="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <input type="text" value="{{$customer->phone ?? ""}}" class="form-control"
                                           name="phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Gender</label>
                                    @if(@$customer->gender == "Female")
                                        <input type="radio" name="gender" value="Male"> Male
                                        <input type="radio" name="gender" value="Female" checked> Female
                                    @else
                                        <input type="radio" name="gender" value="Male" checked> Male
                                        <input type="radio" name="gender" value="Female"> Female
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Date Of Brith</label>
                                    <input type="date" name="dob"
                                           value="{{ $customer->dob ? date('Y-m-d' , strtotime($customer->dob)) : "" }}"
                                           class="form-control">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">TimeZone</label>
                                    <select name="timezone" class="form-control">
                                        <option value="">Select Timezone</option>
                                        @foreach($timezones as $timezone)
                                            <option
                                                value="{{ $timezone->id }}" {{ $customer->timezone == $timezone->id ? 'selected': '' }}>{{ $timezone->abbreviation }}</option>
                                        @endforeach
                                    </select>
                                    {{--                                <input type="time" name="dob" value="{{ $customer->dob ? date('Y-m-d' , strtotime($customer->dob)) : "" }}" class="form-control">--}}

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Age</label>
                                    <input type="text" value="{{$customer->age ?? ""}}" class="form-control" name="age">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Weight</label>
                                    <input type="text" value="{{$customer->weight ?? ""}}" class="form-control"
                                           name="weight">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nationality</label>
                                    <input type="text" value="{{$customer->nationality ?? ""}}" class="form-control"
                                           name="nationality">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Country of Residence</label>
                                    <input type="text" value="{{$customer->residence ?? ""}}" class="form-control"
                                           name="residence">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">City</label>
                                    <input type="text" value="{{$customer->city ?? ""}}" class="form-control"
                                           name="city">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Trainer Assigned </label>
                                    <input type="text" placeholder="None"
                                           value="{{ !empty($trainer) ? $trainer->name : '' }}" class="form-control"
                                           disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="photo">Profile Picture</label>
                                    <input type="file" name="photo" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if($customer->photo)
                                    <img src="{{ asset($customer->photo) }}" width="250px" height="auto" alt="">
                                @endif
                            </div>
                        </div>
                        <button type="submit" href="#" class="btnStyle">EDIT profile</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">

        $(document).ready(function () {

            $('#selecteddays').val([{{$customer->days}}]);
            $('#selecteddays').trigger('change');

        });
    </script>
@endsection
