@extends('layouts.customer')
@section('page-title')
    Dashboard
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style type="text/css">
        .fc-event-container {
            cursor: pointer;
        }

        /* .fc-right .fc-button-group {
                display: none;
            } */

    </style>
@endsection

@section('content')

    <main>
        <div class="content-wrap">
            <h2 class="secHeading">My Plan</h2>
            <div class="calanderWrapp row">
                <div class="col-xl-6">
                    <div id='demo_calendar'></div>
                </div>
                <div class="col-xl-6">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="secHeading">Upcoming Sessions</h2>
                            <div id="upcoming_sessions_month"></div>
                        </div>

                        <!-- Re-Schedule Modal -->
                        <div class="modal fade" id="rescheduleMessage" tabindex="-2" role="dialog"
                             aria-labelledby="rescheduleMessage" aria-hidden="true">

                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalHeaderText1">Re-Schedule</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="modalBodyText1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger" role="alert">
                                                    Sorry your request can not be fullfilled, the request should be made
                                                    prior to 6 hours
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form action="{{ url('customer/cancel-session') }}" method="POST" id="cancelSession">
                            @csrf
                            <input type="hidden" name="customer_to_trainer_id" id="customer_to_trainer_id" value="">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHeaderText"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBodyText">
                    <p><b>Customer: </b>{{ Auth::user()->name }}</p>
                    <p><b>Trainer: </b><span id="trainer"></span></p>
                    <p><b>Trainer Start Date: </b><span id="start_date"></span></p>
                    <p><b>Trainer Start Time: </b><span id="start_time"></span></p>
                    <p><b>Demo Start Date: </b><span id="d_start_date"></span></p>
                    <p><b>Demo Start Time: </b><span id="d_start_time"></span></p>
                    <p><b>Goal: </b><span id="goal"></span></p>
                    <p><b>Message: </b><span id="message"></span></p>
                    <p><b>Status: </b><span id="status"></span></p>
                    {{-- <a class="btn btn-primary" id="reschedule_btn" type="button">Re-schedule</a> --}}
                </div>
            </div>
        </div>
    </div>

@endsection


@section('js')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            var calendarEl = document.getElementById('demo_calendar');
            var demos = @json($demo_data);
            console.log(demos)
            const date = new Date();

            function handleDatesRender(arg) {
                // console.log('viewType1:', arg.view.calendar.state.viewType);
            }

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['interaction', 'dayGrid', 'timeGrid'],
                defaultView: 'dayGridMonth',
                selectable: true,
                defaultDate: date,
                datesRender: function (info) {
                    var startDate = new Date(info.view.calendar.state.dateProfile.currentRange.start).toDateString()
                    var endDate = new Date(info.view.calendar.state.dateProfile.currentRange.end).toDateString()
                    $.ajax({
                        url: "{{route('customer-site-calendar-data-fetch')}}",
                        type: "post",
                        dataType: 'json',
                        data: {
                            start_date: startDate,
                            end_date: endDate
                        },
                        success: function (data) {
                            $('#upcoming_sessions_month').html(data.data);
                        }
                    });
                },

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridWeek, dayGridMonth,'
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
                    $('#modalHeaderText').html(event.event._def.title);

                    $('#trainer').text(event.event.extendedProps.description.trainer.name);
                    $('#start_date').html(event.event.extendedProps.description.trainer_date);
                    $('#start_time').html(event.event.extendedProps.description.trainer_time);

                    $('#goal').html(event.event.extendedProps.description.hasOwnProperty('goals') ? event.event.extendedProps.description.goals : '---');
                    $('#message').html(event.event.extendedProps.description.notes);
                    $('#d_start_date').html(event.event.extendedProps.description.customer_timezone_date);
                    $('#d_start_time').html(event.event.extendedProps.description.customer_timezone_time);
                    $('#session_date').val(event.event.extendedProps.description.session_date);
                    $('#session_time').val(event.event.extendedProps.description.session_time);
                    $('#demo_goal').val(event.event.extendedProps.description.goals);
                    $('#demo_message').val(event.event.extendedProps.description.notes);
                    $('#demo_id').val(event.event._def.publicId);
                    let status = event.event.extendedProps.description.status == 'canceled' ? 'Cancelled' : event.event.extendedProps.description.status.toUpperCase();
                    $('#status').html(status);
                    $('#calendarModal').modal();
                }
            });
            calendar.render();
        });

        $('#reschedule_btn').on('click', function () {
            $('#calendarModal').modal('toggle');
            $('#rescheduleModal').modal();
        });

        $(document).on('click', '.cancel-session',function () {
            var cust_to_trainer_id = $(this).data('cust_to_trainer_id');
            if (confirm("Are you sure you want to cancel this session?")) {
                event.preventDefault();
                $('#customer_to_trainer_id').val(cust_to_trainer_id);
                document.getElementById('cancelSession').submit();
            }
        })

        $(".fc-dayGridWeek-button").click(function () {
            $("#upcoming_sessions_month").hide();
            $("#upcoming_sessions_week").show();
        });

        $(".fc-dayGridMonth-button").click(function () {
            $("#upcoming_sessions_week").hide();
            $("#upcoming_sessions_month").show();

        });
    </script>

@endsection
