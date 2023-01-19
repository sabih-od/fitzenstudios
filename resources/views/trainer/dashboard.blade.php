@extends('layouts.trainer')
@section('page-title')
Dashboard
@endsection
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<style>
    /* .fc-right .fc-button-group {
            display: none !important;
        } */

</style>
@endsection
@section('content')
<main>

    <div class="content-wrap">
        <div class="calanderWrapp row">
            <div class="col-xl-6">
                <h2 class="secHeading">My Sessions</h2>
                <div id='demo_calendar'></div>
            </div>
            <div class="col-xl-6">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="secHeading">Upcoming Sessions</h2>
                        {{-- <span style="float: right;margin-top: -75px;margin-bottom: 20px;">
                                <button style="font-size: 30px;border: none;" type="button" class="btnStyle" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa-solid fa-circle-plus"></i>
                                </button>
                            </span> --}}
                    </div>
                    @forelse ($upcoming_sessions as $item)
                    <div class="col-md-12">
                        <div class="activityCard">
                            <div class="dateWrap">
                                <h2>
                                    {{ date('d', strtotime($item->trainer_timezone_date))}}
                                    <span>{{ date('M', strtotime($item->trainer_timezone_date))}}</span>
                                </h2>
                            </div>
                            <div class="content">
                                <div>
                                    <h3>{{ $item->session_type }}</h3>
                                    <p> {{ $item["customer"]->first_name.' '.$item["customer"]->last_name }}</p>

                                    @if($item->status == "completed")
                                        <span class="badge badge-success">{{ ucfirst($item->status) }}</span>
                                    @elseif($item->status == "re-scheduled")
                                        <span class="badge badge-warning">{{ ucfirst($item->status) }}</span>
                                    @elseif($item->status == "canceled")
                                        <span class="badge badge-danger">{{ ucfirst($item->status) }}</span>
                                    @elseif($item->status == "upcoming")
                                        <span class="badge badge-primary">{{ ucfirst($item->status) }}</span>
                                    @endif

                                </div>
                                <div class="btnWrap">
                                    <span>{{  date('h:i A', strtotime($item->trainer_timezone_time)); }}</span>
                                    {{-- <p class="zone">{{ $item->time_zone ?? "" }}</p> --}}
                                    @if($item->status == "completed")
                                        @if($item->demo_session_id != null)
                                            @php $check = App\Models\Performance::where('demo_session_id',$item->demo_session_id)->first();
                                            @endphp
                                            @if($check == null)
                                                <a href="{{ url('trainer/add-customer-performance/'.$item->id)}}">ADD PERFORMANCE</a>
                                            @endif
                                        @endif
                                        <a href="{{ url('trainer/add-customer-details/'.$item->customer_id)}}">ADD Details</a>

                                    @elseif($item->status == "upcoming")

                                        <a href="#" data-toggle="modal" data-target="#joinMeetingModal{{$loop->iteration}}">JOIN MEETING</a>
                                        <a href="#" data-toggle="modal" data-target="#rescheduleModal{{$loop->iteration}}">RE-SCHEDULE</a>
                                    @else
                                        <a href="#" data-toggle="modal" data-target="#joinMeetingModal{{$loop->iteration}}">JOIN MEETING</a>
                                    @endif
                                    <!-- Begin Join Meeting Popup -->
                                    <div class="modal fade joinMeetingModal" id="joinMeetingModal{{$loop->iteration}}" 
                                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content p-5">
                                                <button type="button" class=" text-right close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span style="font-size: 30px" aria-hidden="true">&times;</span>
                                                </button>
                                                <div class="modal-body text-center">
                                                    <h2 class="secHeading">{{ $item->session_type}}</h2>
                                                    <div class="exerciseCard mb-0 bg-light">
                                                        <a href="#" class="text-dark"
                                                            style="background-color: #f8f9fa">{{ $item->notes }}</a>
                                                    </div>
                                                    {{-- <div class="text-right"><a href="{{ url('trainer/dashboard') }}"
                                                    class="text-dark" style="background-color:#fff"><i
                                                        class="fas fa-share"></i></a>
                                                </div> --}}
                                                <a target="blank" href="{{ $item->start_url }}" class="btnStyle">Join Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Join Meeting Popup -->
                                <!-- Re-Schedule Modal -->
                                <div class="modal fade" id="rescheduleModal{{$loop->iteration}}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalHeaderText1">Re-schedule</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="modalBodyText1">
                                                <form method="POST" action="{{ url('reschedule-request') }}">
                                                    @csrf
                                                    <input type="hidden" name="request_by" value="trainer">
                                                    <input type="hidden" name="session_id" value="{{ $item->id }}">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Select Date</label>
                                                                <input type="date" name="new_session_date"
                                                                    class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Select Time</label>
                                                                <input type="time" name="new_session_time"
                                                                    class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">Reason</label>
                                                                <textarea name="reason" class="form-control" rows="6"
                                                                    placeholder="Tell us reason to re-schedule your session"
                                                                    required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 text-center">
                                                            <!-- <button onclick="window.location.href = 'dashboard.php'" class="btnStyle">BOOK SESSION</button> -->
                                                            <button type="submit" class="btnStyle"
                                                                data-wow-delay="0.6s"><span></span>UPDATE BOOKING
                                                                SESSION</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <h2 style="text-align: center;">Currenty No sessions available..!!</h2>
                @endforelse

            </div>
        </div>

        <!-- Session Popup -->
        {{-- <div class="session-popup">
                    <a href="#" class="popupClone"><i class="fas fa-times"></i></a>
                    <div class="form-group">
                        <label for="">Session Name</label>
                        <input type="text" placeholder="Cardio Session" class="form-control" id="session_name">
                    </div>
                    <div class="form-group">
                        <label for="">Customer Name</label>
                        <input type="text" placeholder="John Smith" class="form-control" id="trainer_name">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Date</label>
                                <input type="text" placeholder="09-03-2022" class="form-control" id="trainer_date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Time</label>
                                <input type="text" placeholder="10:00AM-12:00PM" class="form-control" id="trainer_time">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <input type="text" placeholder="Schedule" class="form-control" id="session_status">
                    </div>
                    <div class="btn-group">
                        <a href="#" data-toggle="modal" data-target="#joinMeetingModal" class="btnStyle">JOIN
                            MEETING</a>
                        <a href="re-schedule.php" class="btnStyle redBtn">Re-Schedule</a>
                        <a href="javascript:;" id="add_cust_url" class="btnStyle">add customer Details</a>
                    </div>
                </div> --}}
        <!-- Session Popup -->

        <!-- Modal -->
        <div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalHeaderText">SESSION DETAIL</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modalBodyText">
                        <p><b>Session Name: </b><span id="session_name"></span></p>
                        <p><b>Customer Name: </b><span id="trainer_name"></span></p>
                        <p><b>Session Start Date: </b><span id="trainer_date"></span></p>
                        <p><b>Session Start Time: </b><span id="trainer_time"></span></p>
                        <p><b>Time Zone: </b><span id="admin_time_zone"></span></p>
                        <p><b>Session Status: </b><span id="session_status"></span></p>
                        <a href="#" data-toggle="modal" data-target="#joinMeetingModal" class="btnStyle">JOIN
                            MEETING</a>
                        <a href="javascript:;" id="add_cust_url" class="btnStyle">add customer Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        var calendarEl = document.getElementById('demo_calendar');
        var demos = @json($demo_data);

        // console.log("data", demos);
        const date = new Date();

        function handleDatesRender(arg) {
            // console.log('viewType1:', arg.view.calendar.state.viewType);
        }

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['interaction', 'dayGrid', 'timeGrid'],
            defaultView: 'dayGridMonth',
            selectable: true,
            datesRender: handleDatesRender,
            defaultDate: date,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth, dayGridWeek, dayGridDay'
            },
            firstDay: 1,
            dateClick: function () {
                $('.session-popup').slideDown(500);
            },
            events: demos,
            eventClick: function (event, jsEvent, view) {
                var cust_detail_url = `{{ url('trainer/add-customer-details/` + event.event
                    .extendedProps.description.customer_id + `')}}`;
                var name = event.event.extendedProps.description.customer.first_name + ' ' + event
                    .event.extendedProps.description.customer.last_name;

                var session_time = tConvert(event.event.extendedProps.description
                    .trainer_timezone_time);
                $('#session_name').text(event.event.extendedProps.description.session_type);
                $('#trainer_name').text(name);
                $('#trainer_date').text(event.event.extendedProps.description
                .trainer_timezone_date);
                $('#trainer_time').text(session_time);
                $("#admin_time_zone").text(event.event.extendedProps.description.time_zone);
                $('#session_status').text(event.event.extendedProps.description.status);
                $("#add_cust_url").attr("href", cust_detail_url);
                $('#calendarModal').modal();
            },

        });
        calendar.render();

        function tConvert(time) {
            // Check correct time format and split into components
            time = time.toString().match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

            if (time.length > 1) { // If time format correct
                time = time.slice(1); // Remove full string match value
                time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
                time[0] = +time[0] % 12 || 12; // Adjust hours
            }
            return time.join(''); // return adjusted time or original string
        }


    });

</script>
@endsection
