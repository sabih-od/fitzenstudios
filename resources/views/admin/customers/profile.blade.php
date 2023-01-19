@extends('layouts.admin-portal')
@section('page-title')
Customer Details
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td colspan = "4">
                        @if(isset($customer->photo))
                            <img src="{{ asset('uploads/images/customer/'.$customer->photo) }}" class=" img-fluid" alt="img">
                            @else
                            <img src="{{ asset('themes/customer/assets/images/default-user.jpg') }}" class="img-fluid" alt="img">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>First Name:</strong></td>
                        <td>{{$customer->first_name}}</td>
                        <td><strong>Last Name:</strong></td>
                        <td>{{$customer->last_name}}</td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td>{{$customer->email}}</td>
                        <td><strong>Phone:</strong></td>
                        <td>{{$customer->phone}}</td>
                    </tr>
                    <tr>
                        <td><strong>Date of Birth:</strong></td>
                        <td>{{$customer->dob}}</td>
                        <td><strong>Age:</strong></td>
                        <td>{{$customer->age}}</td>
                    </tr>
                    <tr>
                        <td><strong>Gender:</strong></td>
                        <td>{{$customer->gender}}</td>
                        <td><strong>Weight:</strong></td>
                        <td>{{$customer->weight}}</td>
                    </tr>
                    <tr>
                        <td><strong>Nationality:</strong></td>
                        <td>{{$customer->nationality}}</td>
                        <td><strong>Country of Residence:</strong></td>
                        <td>{{$customer->residence}}</td>
                    </tr>
                    <tr>
                        <td><strong>City:</strong></td>
                        <td>{{$customer->city}}</td>
                        <td><strong>Time Zone:</strong></td>
                        <td>{{$customer->timezone}}</td>
                    </tr>
                    <tr>
                        <td><strong>Days:</strong></td>
                        <td>
                            <?php
                            $days_array = explode(',', $customer->days);
                            ?>
                            @foreach($days_array as $value)

                                @switch($value)
                                    @case(1)
                                    <span class="badge badge-warning">Monday</span>
                                    @break
                                    @case(2)
                                    <span class="badge badge-warning">Tuesday</span>
                                    @break
                                    @case(3)
                                    <span class="badge badge-warning">Wednesday</span>
                                    @break
                                    @case(4)
                                    <span class="badge badge-warning">Thursday</span>
                                    @break
                                    @case(5)
                                    <span class="badge badge-warning">Friday</span>
                                    @break
                                    @case(6)
                                    <span class="badge badge-warning">Saturday</span>
                                    @break
                                    @case(7)
                                    <span class="badge badge-warning">Sunday</span>
                                    @break
                                @endswitch
                        @endforeach

                        </td>
                        <td><strong>No. of Sessions in a Week:</strong></td>
                        <td>{{$customer->sessions_in_week}}</td>
                    </tr>
                    <tr>
                        <td><strong>Type of Training :</strong></td>
                        <td>{{$customer->training_type}}</td>
                        <td><strong>Trainer:</strong></td>
                        <td>{{$customer->trainer->trainer->name}}</td>
                    </tr>
                </table>

            </div>
            <div class = "card-footer">
            <a href="{{ url('admin/customers') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</div>
@endsection


