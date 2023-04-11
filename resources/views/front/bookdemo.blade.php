<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Fitzen Studio - Demo Session Request</title>
        <!-- Calandar CSS -->
        <link href="https://unpkg.com/@fullcalendar/core@4.3.0/main.min.css" rel="stylesheet" />
        <link href="https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.css" rel="stylesheet" />
        <link href="https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.css" rel="stylesheet" />
        <!-- Calandar CSS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link href="{{ asset('themes/admin/vendor/clock-picker/clockpicker.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('themes/customer/css/slick.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('themes/customer/css/slick-theme.min.css') }}" />
        <link href="{{ asset('themes/customer/css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('themes/customer/css/custom.min.css') }}" rel="stylesheet" />
        <link href="{{asset('themes/admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" >

        <style>
            .booking-wrap {
                height: 200vh;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <main>
            <div class="booking-wrap">
                <div class="container">
                    <a href="#" class="d-block text-center mx-auto"><img src="{{ asset('assets/images/book-logo.png') }}" alt="logo"></a>
                    <div class="row justify-content-center mt-5">
                        <div class="col-md-8 text-center mt-5">
                            @if(session()->has('message') || session()->has('error'))
                                <h2 class="secHeading"></h2>
                            @else
                                <h2 class="secHeading">{{ $content->heading ?? null }}</h2>
                            @endif
                        </div>
                        @if(session()->has('message'))
                            <div class="col-md-12 alert alert-success" style="text-align: center">
                                <span style="font-size: 22px;font-family: times new roman;font-weight: 600;">{{ session()->get('message') }}</span>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <a class="btn btnStyle" href="{{url('customer/dashboard')}}" class="btn">GO TO DASHBOARD</a>
                                </div>
                            </div>
                        @elseif(session()->has('error'))
                            <div class="col-md-12 alert alert-danger" style="text-align: center">
                                <span style="font-size: 22px;font-family: times new roman;font-weight: 600;">{{ session()->get('error') }}</span>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <a class="btn btnStyle" href="{{ url('customer/dashboard') }}" class="btn">GO TO DASHBOARD</a>
                                </div>
                            </div>
                        @else
                            <div class="col-md-8 mt-4">
                                <form  method="POST" action="{{ url('submit-demo') }}">
                                @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="first_name">First name<span style="color: red">*</span></label>
                                                <input type="text" name="first_name" placeholder="Jhon" class="form-control" value="{{Auth::user()->customer->first_name ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="last_name">Last name<span style="color: red">*</span></label>
                                                <input type="text" name="last_name" placeholder="Smith" class="form-control" value="{{ Auth::user()->customer->last_name ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email Address<span style="color: red">*</span></label>
                                                <input type="email" name="email" placeholder="Your Email Address" class="form-control" value=" {{Auth::user()->email ?? ''}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">Phone<span style="color: red">*</span></label>
                                                <input type="text" name="phone" placeholder="+123 456 7890" class="form-control" value=" {{ Auth::user()->phone ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Select Date<span style="color: red">*</span></label>
                                                <input type="date" name="session_date" class="form-control" placeholder="Select Date" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Select Time<span style="color: red">*</span></label>
                                                <input type="text" name="session_time" class="form-control" placeholder="Select Time" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="timezone">Time Zone<span style="color: red">*</span></label>
                                                <select name="time_zone" id="time_zone" class="form-control" required>
                                                    <option value="">Select Time Zone</option>
                                                    @if(count($timezones) > 0)
                                                        @foreach ($timezones as $time)
                                                            @if(auth()->check() && isset(auth()->user()->customer))
                                                                <option style="color: black !important" value="{{ $time->id }}" {{ auth()->user()->customer->time_zone == $time->id ? 'selected' : null }}>{{ $time->zone_name.' '.$time->time_zone }}</option>
                                                            @else
                                                                <option style="color: black !important" value="{{ $time->id }}">{{ $time->zone_name.' '.$time->time_zone }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Your Goals</label>
                                                <textarea name="goals" class="form-control"  rows="6" placeholder="Tell us your goals" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Messages</label>
                                                <textarea name="message" class="form-control"  rows="6" placeholder="Any Additional Information" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <!-- <button onclick="window.location.href = 'dashboard.php'" class="btnStyle">BOOK SESSION</button> -->
                                            <button type="submit" class="btnStyle" data-wow-delay="0.6s"><span></span>BOOK SESSION</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
        <script src="{{asset('themes/admin/vendor/clock-picker/clockpicker.js')}}"></script>

        <!-- Calandar JS -->
        <script src="https://unpkg.com/@fullcalendar/core@4.3.0/main.min.js"></script>
        <script src="https://unpkg.com/@fullcalendar/interaction@4.3.0/main.min.js"></script>
        <script src="https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.js"></script>
        <script src="https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.js"></script>
        <script src="https://unpkg.com/@fullcalendar/list@4.3.0/main.min.js"></script>
        <!-- Calandar JS -->

        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('themes/customer/js/slick.min.js') }}"></script>
        <script src="{{ asset('themes/customer/js/scripts.js') }}"></script>
        <script src="{{ asset('themes/customer/js/custom.min.js') }}"></script>
        <script src="{{asset('themes/admin/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
        <script>
              $('.js-example-basic-single').select2();
              $('[name="session_time"]').clockpicker({
                  autoclose: true,
                  twelvehour: true
              });
        </script>
    </body>
</html>
