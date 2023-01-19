@extends('layouts.admin-portal')
@section('page-title')
    Dashboard
@endsection
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
@endsection
@section('content')
    <main>
        <div class="content-wrap">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="secHeading">Training Requests </h2>
                </div>
                <div class="col-md-12">
                    @forelse ($requests as $item)
                        <div class="performCard">
                            <div class="dateWrap">
                                <h2>{{ date('d', strtotime($item->session_date)) }}
                                    <span>{{ strtoupper(date('M', strtotime($item->session_date))) }}</span></h2>
                            </div>
                            <h3><span>Full Name</span>{{ $item->first_name.' '.$item->last_name ?? " "}}</h3>
                            <h3><span>Email Address</span>{{ $item->email ?? " "}}</h3>
                            <h3><span>Phone Number</span>{{ $item->phone ?? " "}}</h3>
                            {{-- <h3><span>Optional Message</span>{{ $item->message ?? " "}}</h3> --}}
                            <a href="{{ url('admin/demo-session/'.$item->id) }}" class="btnStyle">DEMO SESSION</a>
                        </div>
                    @empty
                        <h4 style="text-align: center">Currently No Requests Available..!!</h4>
                    @endforelse

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2 class="secHeading">Schedule Calendar</h2>
                    <div class="calanderWrapp">
                        <div id='demo_calendar'></div>
                        <!-- Session Popup -->
                        {{-- <div class="session-popup">
                            <a href="#" class="popupClone"><i class="fas fa-times"></i></a>
                            <div class="form-group">
                                <label for="">Session Name</label>
                                <input type="text" class="form-control" id="session_name">
                            </div>
                            <div class="form-group">
                                <label for="">Trainer Name</label>
                                <input type="text"  class="form-control" id="trainer_name">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Session Date</label>
                                        <input type="text"  class="form-control" id="trainer_date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Session Time</label>
                                        <input type="text"  class="form-control" id="trainer_time">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <input style="border-bottom: none;" type="text" placeholder="Schedule" class="form-control" id="session_status">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="btn-group">
                                <a href="#" data-toggle="modal" data-target="#joinMeetingModal" class="btnStyle">JOIN
                                    MEETING</a>
                                <a href="re-schedule.php" class="btnStyle redBtn">Re-Schedule</a>
                                <a href="javascript:;" id="add_cust_url" class="btnStyle">add customer Details</a>
                            </div> --}}
                        {{-- </div>  --}}

                        <div class="modal fade" id="calendarModal" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">

                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalHeaderText">Session Detail</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="modalBodyText">
                                        <p><b>Session Name: </b><span id="session_name"></span></p>
                                        <p><b>Trainer Name: </b><span id="trainer_name"></span></p>
                                        <p><b>Session Date: </b><span id="trainer_date"></span></p>
                                        <p><b>Session Time: </b><span id="trainer_time"></span></p>
                                        <p><b>Status: </b><span id="session_status"></span></p>
                                        {{-- <a href="javascript:;" id="add_cust_url" class="btnStyle">add customer Details</a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Session Popup -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2 class="secHeading">Upcoming Sessions</h2>
                    <span style="float: right;margin-top: -75px;margin-bottom: 20px;">
                {{-- <button style="font-size: 20px;border: none;" type="button" class="btnStyle" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa-solid fa-circle-plus"></i>
                    Create Session
                </button> --}}
                <a href="{{ url('admin/create-session') }}" class="btnStyle">Create Session</a>
            </span>

                    <!-- Modal -->
                    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                       <div class="modal-content">
                           <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Training Session Request</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                           </button>
                           </div>
                           <div class="modal-body">
                               <form method="POST" action="{{ route('admin.assignCustomer') }}" enctype="multipart/form-data" id="assignTrainer">
                                   @csrf

                                   <div class="row">

                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Trainers</label>
                                               <select class="form-control" name="trainer_id" id="trainer_id" required>
                                                   <option value="">Select Trainer</option>
                                                   @foreach($trainers as $trainer)
                                                       <option value="{{ $trainer->id }}">
                                                           {{ $trainer->name.' '.$trainer->last_name }}
                                                       </option>
                                                   @endforeach
                                               </select>
                                           </div>
                                       </div>

                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Customers</label>
                                               <select class="form-control js-example-basic-multiple" name="customer_id[]"  multiple="multiple" id="customer_id" required>
                                                   <option value="">Select Customer</option>
                                                       @foreach ($customers as $item)
                                                           <option value="{{ $item->id }}">
                                                               {{ $item->first_name.' '.$item->last_name }}
                                                           </option>
                                                       @endforeach
                                               </select>
                                           </div>
                                       </div>
                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Session Type</label>
                                               <input type="text" name="session_type" class="form-control" required>
                                           </div>
                                       </div>
                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Session Duration</label>
                                               <input type="text" name="session_duration" class="form-control" required>
                                           </div>
                                       </div>
                                       <div class="col-md-12">

                                           <div class="form-group">
                                               <label for="">Time Zone</label>
                                               <select name="time_zone" id="time_zone" class="form-control">
                                                   @foreach ($zones as $item)
                                                       <option value="{{ $item->zone_name.' '.$item->time_zone }}">{{ $item->zone_name.' '.$item->time_zone }}</option>
                                                   @endforeach
                                               </select>
                                           </div>
                                       </div>
                                       <div class="col-md-6">
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
                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Additional Notes</label>
                                               <textarea placeholder="Write Message" class="form-control" name="notes"></textarea>
                                           </div>
                                       </div>
                                       <div class="col-md-5">
                                           <button class="btnStyle">Assign Session</button>
                                       </div>
                                   </div>
                               </form>
                           </div>
                       </div>
                       </div>
                   </div> --}}
                </div>
                @forelse ($upcoming_sessions as $item)
                    <div class="col-md-6">
                        <div class="activityCard">
                            <div class="dateWrap">
                                <h2>{{ date('d', strtotime($item->trainer_date))}}
                                    <span>{{ date('M', strtotime($item->trainer_date))}}</span></h2>
                            </div>
                            <div class="content">
                                <div>
                                    <h3>{{ $item->session_type }}</h3>
                                    <p>
                                        <strong>Trainer: </strong>{{ $item["trainer"]->name.' '.$item["trainer"]->last_name }}
                                    </p>
                                </div>
                                <div class="btnWrap">
                                    <span>{{  date('h:i A', strtotime($item->trainer_time)); }}</span>
                                    {{-- <a href="join-meeting.php" data-toggle="modal" data-target="#joinMeetingModal">JOIN MEETING</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h2 style="text-align: center;">Currently no sessions available today..!!</h2>
                @endforelse
            </div>
            {{-- <div class="row mt-5">
                <div class="col-md-12">
                    <h2 class="secHeading">Invoices & Payments</h2>
                </div>
                <div class="col-md-12">
                    <div class="table-Wrap table-responsive">
                        <div class="table-row table-head">
                            <div class="table-col"><span>No.</span></div>
                            <div class="table-col"><span>Name</span></div>
                            <div class="table-col"><span>Invoice ID</span></div>
                            <div class="table-col"><span>Date</span></div>
                            <div class="table-col"><span>Email</span></div>
                            <div class="table-col"><span>Payment</span></div>
                            <div class="table-col"><span>Status</span></div>
                            <div class="table-col"><span>Details</span></div>
                        </div>
                        <div class="table-row">
                            <div class="table-col"><span>01</span></div>
                            <div class="table-col"><span>John Smith</span></div>
                            <div class="table-col"><span>123456</span></div>
                            <div class="table-col"><span>15-03-2022</span></div>
                            <div class="table-col"><span>info@youremail.com</span></div>
                            <div class="table-col"><span>$200</span></div>
                            <div class="table-col"><span>Pending</span></div>
                            <div class="table-col"><a href="#" class="btnStyle">VIEW DETAILS</a></div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
    </main>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
        $(document).ready(function () {
            var calendarEl = document.getElementById('demo_calendar');
            var demos = @json($demo_data);
            const date = new Date();

            function handleDatesRender(arg) {
                // console.log('viewType1:', arg.view.calendar.state.viewType);
            }

            function tConvert(time) {
                // Check correct time format and split into components
                time = time.toString().match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

                if (time.length > 1) { // If time format correct
                    time = time.slice(1);  // Remove full string match value
                    time[5] = +time[0] < 12 ? ' AM' : ' PM'; // Set AM/PM
                    time[0] = +time[0] % 12 || 12; // Adjust hours
                }
                return time.join(''); // return adjusted time or original string
            }


            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['interaction', 'dayGrid', 'timeGrid'],
                defaultView: 'dayGridWeek',
                selectable: true,
                datesRender: handleDatesRender,
                defaultDate: date,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek,dayGridDay'
                },
                firstDay: 1,
                dateClick: function () {
                    $('.session-popup').slideDown(500);
                },
                events: demos,

                eventClick: function (event, jsEvent, view) {
                    var cust_detail_url = `{{ url('trainer/add-customer-details/`+event.event.extendedProps.description.customer_id+`')}}`;
                    var name = event.event.extendedProps.description.trainer.name + ' ' + event.event.extendedProps.description.trainer.last_name;
                    var getsessiontime = tConvert(event.event.extendedProps.description.trainer_time);
                    $('#session_name').text(event.event.extendedProps.description.session_type);
                    $('#trainer_name').text(name);
                    $('#trainer_date').text(event.event.extendedProps.description.trainer_date);
                    $('#trainer_time').text(getsessiontime);
                    $('#session_status').text(event.event.extendedProps.description.status);
                    // $("#add_cust_url").attr("href", cust_detail_url);
                    $('#calendarModal').modal();
                },

            });
            calendar.render();
        });
    </script>
@endsection
