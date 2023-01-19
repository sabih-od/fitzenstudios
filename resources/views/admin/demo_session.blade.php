@extends('layouts.admin-portal')
@section('page-title')
Demo Session Request
@endsection

@section('content')
    <main>
        <div class="content-wrap">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="secHeading">Demo Session Request</h2>
                </div>
                <div class="col-md-12">
                    <div class="profile-wrap">
                        <form method="POST" action="{{ route('customer.assignTrainer') }}" enctype="multipart/form-data" id="assignTrainer">
                            @csrf
                            <input type="hidden" id="customer_id" name="customer_id" value="{{ $session->customer_id }}" />
                            <input type="hidden" id="session_id" name="session_id" value="{{ $session->id }}" />
                            <input type="hidden" id="customer_timezone" name="customer_timezone" value="{{ $session->time_zone }}">

                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="mb-4">Customer Details:</h3>
                                </div>
                                <div class="col-md-10">

                                    <ul class="bookSessionList">
                                        <li><span>First Name:</span> {{ $session->first_name }}</li>
                                        <li><span>Last Name:</span> {{ $session->last_name }}</li>
                                        <li><span>Email Address:</span> {{ $session->email }}</li>
                                        <li><span>Phone Number:</span> {{ $session->phone }}</li>
                                        <li><span>Requested Date:</span> {{ date('d-m-Y', strtotime($session->session_date))}}</li>
                                        <li><span>Requested Time:</span> {{ $session->session_time }}</li>
                                        <li><span>Goals:</span> {{ $session->goals }}</li>
                                        <li><span>Message:</span> {{ $session->message }}</li>
                                        <li><span>Time Zone: </span>{{ $session->time_zone ?? "" }}</li>
                                    </ul>
                                </div>
                                <div class="col-md-12">
                                    <h3 class="mb-4">Assign Session:</h3>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="">Session Type</label>
                                       <input type="text" class="form-control" name="session_type" required>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="">Trainer</label>
                                        <select class="form-control" name="trainer_id" id="trainer_id" required>
                                            <option value="">Select Trainer</option>
                                            @foreach($trainers as $trainer)
                                                <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Date</label>
                                        <input type="date" placeholder="Select Date" class="form-control" id="simpleDataInput" name="trainer_date" value="{{ $session->session_date }}" required>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Time</label>
                                        <input type="time" placeholder="Select Time" class="form-control" name="trainer_time" id="trainer_time" value="{{ $session->session_time }}" required>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="">Additional Notes</label>
                                        <textarea placeholder="Write Message" class="form-control" name="notes"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <button class="btnStyle">Confirm Booking</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
