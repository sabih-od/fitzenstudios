@extends('layouts.admin-portal')
@section('page-title')
    Customer Detail
@endsection

@section('style')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection

@section('content')
    <main>
        <div class="content-wrap">
            <div class="row">
                <div class="col-md-12">
                    <nav class="users-tab wow fadeInUp" data-wow-delay="0.9s">
                        <ul class="nav nav-pills" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a aria-controls="one-pane" aria-selected="true" class="nav-link active"
                                   data-toggle="tab" href="#one-pane" id="one-tab" role="tab">Customer Details</a>
                            </li>
                            <li class="nav-item">
                                <a aria-controls="two-pane" aria-selected="false" class="nav-link" data-toggle="tab"
                                   href="#two-pane" id="two-tab" role="tab">Customer scheduleS</a>
                            </li>
                            <li class="nav-item">
                                <a aria-controls="three-pane" aria-selected="false" class="nav-link"
                                   data-toggle="tab" href="#three-pane" id="three-tab" role="tab">Invoices &
                                    Payments</a>
                            </li>
                            <li class="nav-item">
                                <a aria-controls="four-pane" aria-selected="false" class="nav-link"
                                   data-toggle="tab" href="#four-pane" id="four-tab" role="tab">Performance</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-12">
                    <div class="tab-content" id="myTabContent">
                        <div aria-labelledby="one-tab" class="tab-pane fade show active" id="one-pane"
                             role="tabpanel">
                            <div class="profile-wrap">
                                <div class="profileInfo">
                                    <div class="profileImg">
                                        <figure>
                                            <img alt="img" class="rounded-circle img-fluid"
                                                 src="{{ $detail->photo ? asset($detail->photo) :  asset('themes/front/images/profileImg.jpg')}}">
                                        </figure>
                                    </div>
                                    <div class="profileContent">
                                        <h3>{{ ucfirst($detail->first_name).' '.ucfirst($detail->last_name) }}</h3>
                                    </div>
                                </div>
                                <div class="d-flex mb-4 justify-content-between align-items-center">
                                    <h3 class="m-0">Personal Information</h3>
                                </div>
                                <form action="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">First Name</label>
                                                <input class="form-control" disabled type="text"
                                                       value="{{ ucfirst($detail->first_name)}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Last Name</label>
                                                <input class="form-control" disabled type="text"
                                                       value="{{ ucfirst($detail->last_name) ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input class="form-control" disabled type="email"
                                                       value="{{ $detail->email}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Phone</label>
                                                <input class="form-control" disabled type="text"
                                                       value="{{ $detail->phone ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Gender</label>
                                                <input class="form-control" disabled type="text"
                                                       value="{{ $detail->gender }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Date Of Brith</label>
                                                <input class="form-control" disabled type="text"
                                                       value="{{ date('d-m-Y', strtotime($detail->dob)) ?? '' }}">
                                            </div>
                                        </div>

                                    </div>
                                </form>
{{--                                <div class="customer-btn">--}}
{{--                                    <ul class="nav nav-tabs" id="myTab2" role="tablist">--}}
{{--                                        <li class="nav-item" role="presentation">--}}
{{--                                            <a aria-controls="General" aria-selected="true" class="nav-link active"--}}
{{--                                               data-toggle="tab" href="#general" id="general-tab"--}}
{{--                                               role="tab">General</a>--}}
{{--                                        </li>--}}
{{--                                        <li class="nav-item" role="presentation">--}}
{{--                                            <a aria-controls="Fitness" aria-selected="false" class="nav-link"--}}
{{--                                               data-toggle="tab" href="#fitness" id="fitness-tab"--}}
{{--                                               role="tab">Fitness Objective & Workout</a>--}}
{{--                                        </li>--}}
{{--                                        <li class="nav-item" role="presentation">--}}
{{--                                            <a aria-controls="workout" aria-selected="false" class="nav-link"--}}
{{--                                               data-toggle="tab" href="#workout" id="workout-tab" role="tab">Focus--}}
{{--                                                of tte workout & Injuries</a>--}}
{{--                                        </li>--}}
{{--                                        <li class="nav-item" role="presentation">--}}
{{--                                            <a aria-controls="medical" aria-selected="false" class="nav-link"--}}
{{--                                               data-toggle="tab" href="#medical" id="medical-tab"--}}
{{--                                               role="tab">Medical Condition</a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
                                <div class="tab-content" id="myTabContent2">
                                    <div aria-labelledby="home-tab" class="tab-pane fade show active" id="general"
                                         role="tabpanel">
                                        <div class="row">
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">First Name</label>--}}
{{--                                                    <input class="form-control" disabled type="text"--}}
{{--                                                           value="{{  ucfirst($detail->first_name) ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Last Name</label>--}}
{{--                                                    <input class="form-control" disabled type="text"--}}
{{--                                                           value="{{  ucfirst($detail->last_name) ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Email</label>--}}
{{--                                                    <input class="form-control" disabled type="email"--}}
{{--                                                           value="{{ $detail->email }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Phone</label>--}}
{{--                                                    <input class="form-control" disabled type="text"--}}
{{--                                                           value="{{ $detail->phone ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Gender</label>--}}
{{--                                                    <input class="form-control" disabled type="text"--}}
{{--                                                           value="{{ $detail->gender ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Date Of Brith</label>--}}
{{--                                                    <input class="form-control" disabled type="text"--}}
{{--                                                           value="{{ date('d-m-Y', strtotime($detail->dob)) ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Age</label>
                                                    <input class="form-control" disabled type="text"
                                                           value="{{ $detail->age ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Weight</label>
                                                    <input class="form-control" disabled type="text"
                                                           value="{{ $detail->weight ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Nationality</label>
                                                    <input class="form-control" disabled type="text"
                                                           value="{{ $detail->nationality ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Country of Residence</label>
                                                    <input class="form-control" disabled type="text"
                                                           value="{{ $detail->residence ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">City</label>
                                                    <input class="form-control" disabled type="text"
                                                           value="{{ $detail->city ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Times Zone</label>
                                                    <input class="form-control" disabled type="text"
                                                           value="{{ $detail->timeZone->abbreviation ?? $detail->time_zone }}">
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Days Available <span id="selectedId"></span></label>
                                                    <select id="selecteddays" multiple>
                                                    </select>
                                                </div>
                                            </div> --}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">No. of Sessions in a Week</label>--}}
{{--                                                    <input class="form-control" disabled type="text"--}}
{{--                                                           value="{{ $detail->sessions_in_week ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Type of Training</label>--}}
{{--                                                    <input class="form-control" disabled type="text"--}}
{{--                                                           value="{{ $cust_detail->training_type ?? ''}}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Trainer Assigned</label>
                                                    @if(count($schedules) > 0)
                                                        <input class="form-control" disabled type="text"
                                                               value="{{ ucfirst($schedules[0]['trainer']->name).' '.ucfirst($schedules[0]['trainer']->last_name) ?? '' }}">
                                                    @else
                                                        <input class="form-control" disabled type="text"
                                                               value="No Trainer Assigned Yet">
                                                    @endif
                                                    {{-- <input class="form-control" disabled type="text" value="{{ ucfirst($schedules[0]['trainer']->name).' '.ucfirst($schedules[0]['trainer']->last_name) ?? '' }}"> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
{{--                                    <div aria-labelledby="fitness-tab" class="tab-pane fade" id="fitness"--}}
{{--                                         role="tabpanel">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">First Name</label> <input class="form-control"--}}
{{--                                                                                            disabled type="text"--}}
{{--                                                                                            value="{{  ucfirst($detail->first_name) ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Last Name</label> <input class="form-control"--}}
{{--                                                                                           disabled type="text"--}}
{{--                                                                                           value="{{  ucfirst($detail->last_name) ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Email</label> <input class="form-control" disabled--}}
{{--                                                                                       type="email"--}}
{{--                                                                                       value="{{  $detail->email ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Phone</label> <input class="form-control" disabled--}}
{{--                                                                                       type="text"--}}
{{--                                                                                       value="{{  $detail->phone ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Gender</label> <input class="form-control"--}}
{{--                                                                                        disabled type="text"--}}
{{--                                                                                        value="{{  $detail->gender ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Date Of Brith</label> <input class="form-control"--}}
{{--                                                                                               disabled type="text"--}}
{{--                                                                                               value="{{ date('d-m-Y', strtotime($detail->dob)) ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Age</label> <input class="form-control" disabled--}}
{{--                                                                                     type="text"--}}
{{--                                                                                     value="{{ $detail->age ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Weight</label> <input class="form-control"--}}
{{--                                                                                        disabled type="text"--}}
{{--                                                                                        value="{{ $detail->weight ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Nationality</label> <input class="form-control"--}}
{{--                                                                                             disabled type="text"--}}
{{--                                                                                             value="{{ $detail->nationality ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Country of Residence</label> <input--}}
{{--                                                        class="form-control" disabled type="text"--}}
{{--                                                        value="{{ $detail->residence ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">City</label> <input class="form-control" disabled--}}
{{--                                                                                      type="text"--}}
{{--                                                                                      value="{{ $detail->city ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Time Zone</label> <input class="form-control"--}}
{{--                                                                                           disabled type="text"--}}
{{--                                                                                           value="{{ $detail->timeZone->abbreviation ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            --}}{{-- <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label>Days Available <span id="selectedId"></span></label>--}}
{{--                                                    <select id="selecteddays" multiple>--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div> --}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">No. of Sessions in a Week</label> <input--}}
{{--                                                        class="form-control" disabled type="text"--}}
{{--                                                        value="{{ $detail->sessions_in_week ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Type of Training</label>--}}
{{--                                                    <input class="form-control" disabled type="text"--}}
{{--                                                           value="{{ $cust_detail->training_type ?? ''}}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Trainer Assigned</label>--}}
{{--                                                    @if(count($schedules) > 0) {--}}
{{--                                                    <input class="form-control" disabled type="text"--}}
{{--                                                           value="{{ ucfirst($schedules[0]['trainer']->name).' '.ucfirst($schedules[0]['trainer']->last_name) ?? '' }}">--}}
{{--                                                    @else--}}
{{--                                                        <input class="form-control" disabled type="text"--}}
{{--                                                               value="No Trainer Assigned Yet">--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div aria-labelledby="workout-tab" class="tab-pane fade" id="workout"--}}
{{--                                         role="tabpanel">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">First Name</label> <input class="form-control"--}}
{{--                                                                                            disabled type="text"--}}
{{--                                                                                            value="{{  ucfirst($detail->first_name) ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Last Name</label> <input class="form-control"--}}
{{--                                                                                           disabled type="text"--}}
{{--                                                                                           value="{{  ucfirst($detail->last_name) ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Email</label> <input class="form-control" disabled--}}
{{--                                                                                       type="email"--}}
{{--                                                                                       value="{{  $detail->email ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Phone</label> <input class="form-control" disabled--}}
{{--                                                                                       type="text"--}}
{{--                                                                                       value="{{  $detail->phone ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Gender</label> <input class="form-control"--}}
{{--                                                                                        disabled type="text"--}}
{{--                                                                                        value="{{  $detail->gender ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Date Of Brith</label> <input class="form-control"--}}
{{--                                                                                               disabled type="text"--}}
{{--                                                                                               value="{{ date('d-m-Y', strtotime($detail->dob)) ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Age</label> <input class="form-control" disabled--}}
{{--                                                                                     type="text"--}}
{{--                                                                                     value="{{  $detail->age ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Weight</label> <input class="form-control"--}}
{{--                                                                                        disabled type="text"--}}
{{--                                                                                        value="{{  $detail->weight ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Nationality</label> <input class="form-control"--}}
{{--                                                                                             disabled type="text"--}}
{{--                                                                                             value="{{ $detail->nationality ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Country of Residence</label> <input--}}
{{--                                                        class="form-control" disabled type="text"--}}
{{--                                                        value="{{ $detail->residence ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">City</label> <input class="form-control" disabled--}}
{{--                                                                                      type="text"--}}
{{--                                                                                      value="{{ $detail->city ?? ''}}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Time Zone</label> <input class="form-control"--}}
{{--                                                                                           disabled type="text"--}}
{{--                                                                                           value="{{ $detail->timezone }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            --}}{{-- <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label>Days Available <span id="selectedId"></span></label>--}}
{{--                                                    <select id="selecteddays" multiple>--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div> --}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">No. of Sessions in a Week</label> <input--}}
{{--                                                        class="form-control" disabled type="text"--}}
{{--                                                        value="{{ $detail->sessions_in_week ?? ''}}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Type of Training</label>--}}
{{--                                                    <input class="form-control" disabled type="text"--}}
{{--                                                           value="{{ $cust_detail->training_type ?? ''}}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Trainer Assigned</label>--}}
{{--                                                    @if(count($schedules) > 0) {--}}
{{--                                                    <input class="form-control" disabled type="text"--}}
{{--                                                           value="{{ ucfirst($schedules[0]['trainer']->name).' '.ucfirst($schedules[0]['trainer']->last_name) ?? '' }}">--}}
{{--                                                    @else--}}
{{--                                                        <input class="form-control" disabled type="text"--}}
{{--                                                               value="No Trainer Assigned Yet">--}}
{{--                                                    @endif--}}
{{--                                                    --}}{{-- <input class="form-control" disabled type="text" value="{{ ucfirst($schedules[0]['trainer']->name).' '.ucfirst($schedules[0]['trainer']->last_name) ?? '' }}"> --}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div aria-labelledby="medical-tab" class="tab-pane fade" id="medical"--}}
{{--                                         role="tabpanel">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">First Name</label> <input class="form-control"--}}
{{--                                                                                            disabled type="text"--}}
{{--                                                                                            value="{{  ucfirst($detail->first_name) ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Last Name</label> <input class="form-control"--}}
{{--                                                                                           disabled type="text"--}}
{{--                                                                                           value="{{  ucfirst($detail->last_name) ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Email</label> <input class="form-control" disabled--}}
{{--                                                                                       type="email"--}}
{{--                                                                                       value="{{  $detail->email ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Phone</label> <input class="form-control" disabled--}}
{{--                                                                                       type="text"--}}
{{--                                                                                       value="{{  $detail->phone ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Gender</label> <input class="form-control"--}}
{{--                                                                                        disabled type="text"--}}
{{--                                                                                        value="{{  $detail->gender ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Date Of Brith</label> <input class="form-control"--}}
{{--                                                                                               disabled type="text"--}}
{{--                                                                                               value="{{ date('d-m-Y', strtotime($detail->dob)) ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Age</label> <input class="form-control" disabled--}}
{{--                                                                                     type="text"--}}
{{--                                                                                     value="{{  $detail->age ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Weight</label> <input class="form-control"--}}
{{--                                                                                        disabled type="text"--}}
{{--                                                                                        value="{{  $detail->weight ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Nationality</label> <input class="form-control"--}}
{{--                                                                                             disabled type="text"--}}
{{--                                                                                             value="{{ $detail->nationality ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Country of Residence</label> <input--}}
{{--                                                        class="form-control" disabled type="text"--}}
{{--                                                        value="{{ $detail->residence ?? '' }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">City</label> <input class="form-control" disabled--}}
{{--                                                                                      type="text"--}}
{{--                                                                                      value="{{ $detail->city ?? ''}}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Time Zone</label> <input class="form-control"--}}
{{--                                                                                           disabled type="text"--}}
{{--                                                                                           value="">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            --}}{{-- <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label>Days Available <span id="selectedId"></span></label>--}}
{{--                                                    <select id="selecteddays" multiple>--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div> --}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">No. of Sessions in a Week</label> <input--}}
{{--                                                        class="form-control" disabled type="text"--}}
{{--                                                        value="{{ $detail->sessions_in_week ?? ''}}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Type of Training</label>--}}
{{--                                                    <input class="form-control" disabled type="text"--}}
{{--                                                           value="{{ $cust_detail->training_type ?? ''}}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Trainer Assigned</label>--}}
{{--                                                    @if(count($schedules) > 0) {--}}
{{--                                                    <input class="form-control" disabled type="text"--}}
{{--                                                           value="{{ ucfirst($schedules[0]['trainer']->name).' '.ucfirst($schedules[0]['trainer']->last_name) ?? '' }}">--}}
{{--                                                    @else--}}
{{--                                                        <input class="form-control" disabled type="text"--}}
{{--                                                               value="No Trainer Assigned Yet">--}}
{{--                                                    @endif--}}
{{--                                                    --}}{{-- <input class="form-control" disabled type="text" value="{{ ucfirst($schedules[0]['trainer']->name).' '.ucfirst($schedules[0]['trainer']->last_name) ?? '' }}"> --}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>

                        <div aria-labelledby="two-pane" class="tab-pane fade" id="two-pane" role="tabpanel">
                            <h2 class="trainerHead">Customer Schedules</h2>
                            <div class="row">
                                @forelse ($schedules as $item)
                                    <div class="col-md-12">
                                        <div class="performCard">
                                            <div class="dateWrap">
                                                <h2>{{ date('d', strtotime($item->trainer_date))}}
                                                    <span>{{ date('M', strtotime($item->trainer_date))}}</h2>
                                            </div>
                                            <h3><span>Full Name</span>{{ $item->session_type }}</h3>
                                            <h3>
                                                <span>Customer Name</span>{{ $item["customer"]->first_name.' '.$item["customer"]->last_name }}
                                            </h3>
                                            <h3>
                                                <span>Trainer Name</span>{{ $item["trainer"]->name.' '.$item["trainer"]->last_name ?? '' }}
                                            </h3>
                                            <h3><span>Time</span>{{ $item->trainer_time }}</h3>
                                            <h3><span>Status</span>{{ $item->status}}</h3>
                                            <a href="{{ url('admin/performance-detail/'.$item->id)}}" class="btnStyle">VIEW
                                                DETAILS</a>
                                        </div>
                                    </div>
                                @empty
                                    <h4 style="text-align: center">No Schedule Available...!!</h4>
                                @endforelse
                            </div>
                        </div>
                        <div aria-labelledby="three-tab" class="tab-pane fade" id="three-pane" role="tabpanel">
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <h2 class="secHeading">Invoices & Payments</h2>
                                    <!-- Button trigger modal -->
                                    <button type="button" id="addPayment" style="float: right;" class="btnStyle"
                                            data-toggle="modal" data-target="#exampleModal">
                                        Add Payment
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Payment</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ url('admin/add-payment') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="customer_id"
                                                               value="{{ $detail->id }}">
                                                        <div class="form-group">
                                                            <label for="">Invoice</label>
                                                            <input type="text" name="invoice" id="invoice"
                                                                   class="form-control" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Customer Name</label>
                                                            <input type="text" name="customer_name" readonly
                                                                   class="form-control"
                                                                   value="{{ $detail->first_name.' '.$detail->last_name ?? '' }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Customer Email</label>
                                                            <input type="text" name="customer_email" readonly
                                                                   class="form-control"
                                                                   value="{{ $detail->email ?? '' }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Payment</label>
                                                            <input type="number" name="payment" class="form-control"
                                                                   required min="1">
                                                        </div>
                                                        <div class="form-group">
                                                            <button class="btnStyle" type="submit">Add</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>No.</th>
                                                <th>Invoice ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Payment</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse ($payments as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->invoice }}</td>
                                                    <td>{{ $item->customer_name }}</td>
                                                    <td>{{ $item->customer_email }}</td>
                                                    <td>{{ $item->payment }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                                    @if($item->status == "paid")
                                                        <td class="table-col">
                                                        <span style="color: #fff;"
                                                              class="badge badge-pill badge-success">Paid</span>
                                                        </td>
                                                    @else
                                                        <td class="table-col">
                                                        <span style="color: #fff;"
                                                              class="badge badge-pill badge-danger">Unpaid</span>
                                                        </td>
                                                    @endif

                                                    {{-- <div class="table-col">
                                                    <span>{{ $item->status }}</span></div> --}}
                                                    {{-- <div class="table-col"><a href="#" class="btnStyle">VIEW DETAILS</a> --}}
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="100%" class="text-center"><span>No Payments Yet...!!</span></td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div aria-labelledby="four-pane" class="tab-pane fade" id="four-pane" role="tabpanel">
                            <h2 class="trainerHead">Customer Schedules</h2>
                            <div class="container-fluid">
                                <div class="row">
                                    @forelse ($performances as $item)

                                        @php  $trainer = App\Models\Trainer::where('id', $item->trainer_id)->first(); @endphp
                                        <div class="col-md-12">
                                            <div class="performCard">
                                                <div class="dateWrap">
                                                    <h2>{{ date('d', strtotime($item->trainer_date))}}
                                                        <span>{{ date('M', strtotime($item->trainer_date))}}</h2>
                                                </div>
                                                <h3><span>Time</span>{{ $item["session"]->trainer_time }}</h3>
                                                @if($trainer != null)
                                                    <h3>
                                                        <span>Trainer Name</span>{{ $trainer->name.' '.$trainer->last_name ?? "" }}
                                                    </h3>
                                                @endif
                                                {{-- <h3><span>Trainer Name</span>{{ $item['trainer'][0]->name.' '.$item['trainer'][0]->last_name }}</h3> --}}

                                                {{-- <h3><span>Status</span> {{}}</h3> --}}
                                                {{-- <h3>
                                                    <span>Workout</span>
                                                    <div class='badge badge-dark text-white'>Cardio Session</div>
                                                    <div class='badge badge-dark text-white'>Metabolic Assessment</div>
                                                    <div class='badge badge-dark text-white'>Cardio Session</div>
                                                </h3> --}}
                                                <a href="{{ url('admin/performance-detail/'.$item->session_id) }}"
                                                   class="btnStyle">VIEW
                                                    DETAILS</a>
                                            </div>
                                        </div>
                                    @empty
                                        <h4 style="text-align: center">No Performances Available...!!</h4>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('custom-js-scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            const getRandomId = (min = 0, max = 500000) => {
                min = Math.ceil(min);
                max = Math.floor(max);
                const num = Math.floor(Math.random() * (max - min + 1)) + min;
                return num.toString().padStart(6, "0")
            };

            $(document).on('click', '#addPayment', function () {
                old_min = 1;
                old_max = 5000000;
                min = Math.ceil(old_min);
                max = Math.floor(old_max);
                const num = Math.floor(Math.random() * (max - min + 1)) + min;

                $('#invoice').val('FZ-' + num.toString().padStart(6, "0"));

            });
        });

    </script>
@endpush
