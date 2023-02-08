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
        <h2 class="secHeading">My Progress</h2>
        <div class="calanderWrapp row">
            <div class="col-xl-6">
                <div id='demo_calendar'></div>
            </div>
            <div class="col-xl-6">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="secHeading">Upcoming Sessions</h2>
                    </div>
                    @forelse ($upcoming_sessions as $item)
                        <div class="col-md-12">
                            <div class="activityCard">
                                <div class="dateWrap">
                                    <h2>{{ date('d', strtotime($item->customer_timezone_date))}}
                                        <span>{{ date('M', strtotime($item->customer_timezone_date))}}</h2>
                                </div>
                                <div class="content">
                                    <div>
                                        <h3>{{ $item->session_type }}</h3>
                                        <p> {{ $item["customer"]->first_name.' '.$item["customer"]->last_name }}</p>
                                        <div class="rate p-0">
                                            @if($item["reviews"])
                                            @if($item["reviews"]["rating"] == 5)

                                            <input type="radio" id="star5" name="rating" checked value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rating" checked value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rating" checked value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rating" checked value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rating" checked value="1" />
                                            <label for="star1" title="text">1 star</label>

                                            @elseif($item["reviews"]["rating"] == 4)
                                            <input type="radio" id="star5" name="rating" checked value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rating" checked value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rating" checked value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rating" checked value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                            @elseif($item["reviews"]["rating"] == 3)
                                            <input type="radio" id="star5" name="rating" checked value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rating" checked value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rating" checked value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rating" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                            @elseif($item["reviews"]["rating"] == 2)
                                            <input type="radio" id="star5" name="rating" checked value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rating" checked value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rating" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rating" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                            @elseif($item["reviews"]["rating"] == 1)
                                            <input type="radio" id="star5" name="rating" checked value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rating" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rating" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rating" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                            @else
                                            <input type="radio" id="star5" name="rating" value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rating" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rating" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rating" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                            @endif
                                            @endif

                                        </div>
                                        @if($item->status == "completed")
                                        <span class="badge badge-success">{{$item->status}}</span>
                                        @elseif($item->status == "re-scheduled")
                                        <span class="badge badge-warning">{{$item->status }}</span>
                                        @elseif($item->status == "cancelled")
                                        <span class="badge badge-danger">{{$item->status}}</span>
                                        @elseif($item->status == "upcoming")
                                        <span class="badge badge-primary">{{$item->status }}</span>
                                        @endif
                                    </div>
                                    <div class="btnWrap">

                                        <span>{{  date('h:i A', strtotime($item->customer_timezone_time)) }}</span>
                                        {{-- <p class="zone">{{ $item->time_zone ?? "" }}</p> --}}
                                        @if($item->status == "completed")
                                            <a href="{{ url('customer/performance-detail/'.$item->id) }}">View Performance</a>
                                        {{-- <a href="{{ url('trainer/add-customer-performance/'.$item->id)}}">ADD
                                        PERFORMANCE</a>
                                        <a href="{{ url('trainer/add-customer-details/'.$item->customer_id)}}">ADD
                                            Details</a> --}}
                                        @elseif($item->status == "upcoming")
                                            <a href="#" data-toggle="modal" data-target="#joinMeetingModal{{$loop->iteration}}"class="mb-2">JOIN MEETING</a>
                                            <a href="javascript:;" class="mb-2 cancel-session btn- btn-danger" data-cust_to_trainer_id="{{ $item->id }}">Cancel Session</a>

                                            @php
                                                $user_id     = Auth::user()->id;
                                                $get_cust_id = App\Models\Customer::where('user_id',
                                                $user_id)->pluck('id')->first();
                                                $date = \Carbon\Carbon::parse($item->trainer_date.' '.$item->trainer_time);
                                                $now  = \Carbon\Carbon::now();
                                                $diff = $date->diffInHours($now);
                                            @endphp

                                        @if($diff >= 6)
                                            <a href="#" data-toggle="modal" data-target="#rescheduleModal{{$loop->iteration}}">RE-SCHEDULE</a>
                                        @else
                                            <a href="#" data-toggle="modal" data-target="#rescheduleMessage"class="">RE-SCHEDULE</a>
                                        @endif

                                        @elseif($item->status == "re-scheduled")
                                            <a href="#"  data-toggle="modal" data-target="#joinMeetingModal{{$loop->iteration}}">JOIN MEETING</a>
                                            <a href="javascript:;" class="cancel-session btn- btn-danger" data-cust_to_trainer_id="{{ $item->id }}">Cancel Session</a>
                                        @else
                                        @endif
                                        <!-- Begin Join Meeting Popup -->
                                        <div class=" modal fade joinMeetingModal" id="joinMeetingModal{{$loop->iteration}}"
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
                                                        {{-- <div class="text-right"><a
                                                                        href="{{ url('trainer/dashboard') }}"
                                                        class="text-dark" style="background-color:#fff"><i
                                                            class="fas fa-share"></i></a>
                                                    </div> --}}
                                                    <a target="blank" href="{{ $item->start_url }}" class="btnStyle">Join
                                                        Now</a>

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
                                                    <h5 class="modal-title" id="modalHeaderText1">
                                                        Re-schedule</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" id="modalBodyText1">
                                                    <form method="POST" action="{{ url('reschedule-request') }}">
                                                        @csrf
                                                        <input type="hidden" name="request_by" id="request_by"
                                                            value="customer">
                                                        <input type="hidden" name="session_id" id="session_id"
                                                            value="{{ $item->id }}">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Select Date</label>
                                                                    <input type="date" name="new_session_date"
                                                                        id="new_session_date" class="form-control" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Select Time</label>
                                                                    <input type="time" name="new_session_time"
                                                                        id="new_session_time" class="form-control" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="">Reason</label>
                                                                    <textarea name="reason" id="reason" class="form-control"
                                                                        rows="6"
                                                                        placeholder="Tell us reason to re-schedule your session"
                                                                        required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 text-center">
                                                                <!-- <button onclick="window.location.href = 'dashboard.php'" class="btnStyle">BOOK SESSION</button> -->
                                                                <button type="submit" class="btnStyle"
                                                                    data-wow-delay="0.6s"><span></span>UPDATE
                                                                    BOOKING SESSION
                                                                </button>
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
                        <div class="col-md-12">
                            <h4>Currently no sessions available..!!</h4>
                        </div>
                    @endforelse

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
                {{-- <a class="btn btn-primary" id="reschedule_btn" type="button">Re-schedule</a> --}}
            </div>
        </div>
    </div>
</div>

@endsection


@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        var calendarEl = document.getElementById('demo_calendar');
        var demos = @json($demo_data);
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
            // header: {
            //     left: 'prev,next today',
            //     center: 'title',
            //     right: 'timeGridWeek,timeGridDay'
            // },
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
            eventClick: function (event, jsEvent, view) {
                console.log(event.event._def);
                $('#modalHeaderText').html(event.event._def.title);

                $('#trainer').text(event.event.extendedProps.description.customer.trainer.name);
                $('#start_date').html(event.event.extendedProps.description.customer.trainer
                    .trainer_date);
                $('#start_time').html(event.event.extendedProps.description.customer.trainer
                    .trainer_time);

                $('#goal').html(event.event.extendedProps.description.goals);
                $('#message').html(event.event.extendedProps.description.message);
                $('#d_start_date').html(event.event.extendedProps.description.customer.trainer.customer_timezone_date);
                $('#d_start_time').html(event.event.extendedProps.description.customer.trainer.customer_timezone_time);
                $('#session_date').val(event.event.extendedProps.description.session_date);
                $('#session_time').val(event.event.extendedProps.description.session_time);
                $('#demo_goal').val(event.event.extendedProps.description.goals);
                $('#demo_message').val(event.event.extendedProps.description.message);
                $('#demo_id').val(event.event._def.publicId);
                // $('#eventUrl').attr('href',event.url);
                $('#calendarModal').modal();
            },

        });
        calendar.render();
    });

    $('#reschedule_btn').on('click', function () {
        $('#calendarModal').modal('toggle');
        $('#rescheduleModal').modal();
    });

    $('.cancel-session').click(function () {
        var cust_to_trainer_id = $(this).data('cust_to_trainer_id');
        if (confirm("Are you sure you want to cancel this session?")) {
            event.preventDefault();
            $('#customer_to_trainer_id').val(cust_to_trainer_id);
            document.getElementById('cancelSession').submit();
        }
    })

    $(".fc-dayGridWeek-button").click(function(){
        $("#upcoming_sessions_month").hide();
        $("#upcoming_sessions_week").show();
    });

    $(".fc-dayGridMonth-button").click(function(){
        $("#upcoming_sessions_week").hide();
        $("#upcoming_sessions_month").show();

    });

</script>

@endsection
