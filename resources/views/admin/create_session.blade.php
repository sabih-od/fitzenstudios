@extends('layouts.admin-portal')
@section('page-title')
Create Session
@endsection
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        .fa-solid, .fas {
            color: var(--theme-color);
            font-size: 30px;
        }
    </style>
@endsection
@section('content')
    <main>
        <div class="content-wrap">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="secHeading">Create Session</h2>
                </div>
                <div class="col-md-12">
                    <div class="profile-wrap">
                        <form method="POST" action="{{ route('admin.assignCustomer') }}" enctype="multipart/form-data" id="assignTrainer">
                            @csrf
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Trainer</label>
                                        <select class="form-control" name="trainer_id" id="trainer_id" required>
                                            <option value="">Select Trainer</option>
                                            @foreach($trainers as $trainer)
                                                <option value="{{ $trainer->id }}" {{ old('trainer_id', '') == $trainer->id ? 'selected' : '' }}>{{ $trainer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Customers</label>
                                        <select class="form-control js-example-basic-multiple" name="customer_id[]"  multiple="multiple" id="customer_id" required>
                                            <option value="">Select Customer</option>
                                                @foreach ($customers as $item)
                                                    <option value="{{ $item->id }}" {{ old('customer_id', '') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->first_name.' '.$item->last_name }}
                                                    </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Session Type</label>
                                       <input type="text" class="form-control" name="session_type" value="{{ old('session_type', '') }}" required>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Session Duration</label>
                                        <input type="number" name="session_duration" class="form-control" required>
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Time Zone</label>
                                        <select name="time_zone" id="time_zone" class="form-control">
                                            @foreach ($zones as $item)
                                            {{-- <option value="{{ $item->timezone_value }}" {{ old('time_zone', '') == $item->timezone_value ? 'selected' : '' }}>{{ $item->zone_name.' '.$item->time_zone }}</option>--}}
                                            <!--<input type="hidden"value="{{ $item->id}}"name="time_zone">-->
                                                <option value="{{ $item->id}}" {{ old('time_zone', '') == $item->id ? 'selected' : '' }}>{{ $item->zone_name.' '.$item->time_zone }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Additional Notes</label>
                                        <textarea placeholder="Write Message" class="form-control" name="notes">{{ old('notes', '') }}</textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Date</label>
                                        <input type="date" placeholder="Select Date" class="form-control" id="simpleDataInput" name="trainer_date" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Time</label>
                                        <input type="time" placeholder="Select Time" class="form-control" name="trainer_time" id="trainer_time" required>
                                    </div>
                                </div>
                              --}}
                                <div class="col-md-12">
                                    <table class="table" id="customFields">
                                        <tr>
                                            <th style="text-align: center;">Session Date</th>
                                            <th style="text-align: center;">Session Time</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                        <div class="row">

                                            <tr valign="top">
                                                <td>
                                                    <input type="date" placeholder="Select Date" class="form-control" name="trainer_date[]" required>
                                                </td>
                                                <td>
                                                    <input type="time" placeholder="Select Time" class="form-control" name="trainer_time[]" required>

                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="javascript:void(0);" class="addCF"><i class="fa-solid fa-circle-plus"></i></a>
                                                </td>
                                            </tr>
                                        </div>
                                    </table>
                                </div>
                                <div class="col-md-5">
                                    <button class="btnStyle">Assign Session</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
        $(document).ready(function(){
        $(".addCF").click(function(){
            $("#customFields").append('<tr valign="top"><td><input type="date" placeholder="Select Date" class="form-control" name="trainer_date[]" required> </td><td> <input type="time" placeholder="Select Time" class="form-control" name="trainer_time[]" required></td><td style="text-align:center"><a href="javascript:void(0);" class="remCF"><i style="color: red;" class="fa-solid fa-trash-can"></i></a></td></tr>');
        });
        $("#customFields").on('click','.remCF',function(){
            $(this).parent().parent().remove();
        });
    });
    </script>
@endsection
