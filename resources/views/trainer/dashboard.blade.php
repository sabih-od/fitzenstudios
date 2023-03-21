@extends('layouts.trainer')
@section('page-title')
Dashboard
@endsection
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

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


                     <div id="upcoming_sessions_month"></div>
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
                        <p><b>Session Status: </b><label class="badge badge-info"><span id="session_status"></span></label></p>
{{--                        <a href="#" data-toggle="modal" data-target="#joinMeetingModal" class="btnStyle">JOIN--}}
{{--                            MEETING</a>--}}
{{--                        <a href="javascript:;" id="add_cust_url" class="btnStyle">add customer Details</a>--}}
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
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        var calendarEl = document.getElementById('demo_calendar');
        var demos = @json($demo_data);
        // console.log("data", demos);
        const date = new Date();

        function handleDatesRender(arg) {
            // console.log('viewType1:', arg.view.calendar.state.viewType);
        }
        console.log(demos)

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['interaction', 'dayGrid', 'timeGrid'],
            defaultView: 'dayGridMonth',
            selectable: true,
            // datesRender: handleDatesRender,
            defaultDate: date,
            datesRender: function(info) {
                var startDate = new Date(info.view.calendar.state.dateProfile.currentRange.start).toDateString()
                var endDate = new Date(info.view.calendar.state.dateProfile.currentRange.end).toDateString()

                $.ajax({

                    url: "{{route('calendardatafetch')}}",
                    type: "post",
                    dataType:'json',
                    data: {
                        start_date: startDate,
                        end_date: endDate
                    },
                    success: function(data) {
                        $('#upcoming_sessions_month').html(data.data);
                    }
                });
            },
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth, dayGridWeek,'
            },
            firstDay: 1,
            dateClick: function () {
                $('.session-popup').slideDown(500);
            },
            events: demos,
            eventRender: function(event, element) {
                if(event.event.rendering == "canceled" || event.event.rendering == "cancelled") {
                    event.el.classList.add("bg-danger")
                    event.el.classList.add("border-danger")
                }
            },
            eventClick: function (event, jsEvent, view) {
                var cust_detail_url = `{{ url('trainer/add-customer-details/` + event.event
                    .extendedProps.description.customer_id + `')}}`;

                var name = event.event.extendedProps.description.customer.first_name + ' ' + event
                    .event.extendedProps.description.customer.last_name;

                var session_time = tConvert(event.event.extendedProps.description
                    .trainer_timezone_time);
                $('#session_name').text(event.event.extendedProps.description.session_type);
                $('#trainer_name').text(name);
                $('#trainer_date').text(event.event.extendedProps.description.trainer_timezone_date);
                $('#trainer_time').text(session_time);
                $("#admin_time_zone").text(event.event.extendedProps.description.time_zone.abbreviation);
                $("#add_cust_url").attr("href", cust_detail_url);

                let status = event.event.extendedProps.description.status == 'canceled' ? 'Cancelled' : event.event.extendedProps.description.status.toUpperCase(),
                    requestSessionStatus = event.event.extendedProps.description.request_session !== null ? event.event.extendedProps.description.request_session.status : null,
                    finalStatus = requestSessionStatus == 'pending' ? 'Applied for reschedule' : status;
                $('#session_status').text(finalStatus);

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


        $(document).ready(function(){



        // $(".fc-dayGridWeek-button").click(function(){
        //     $("#upcoming_sessions_month").hide();
        //     $("#upcoming_sessions_week").show();
        // });
        //
        //     $(".fc-dayGridMonth-button").click(function(){
        //         $("#upcoming_sessions_week").hide();
        //         $("#upcoming_sessions_month").show();
        //
        //     });



        });


</script>
@endsection
