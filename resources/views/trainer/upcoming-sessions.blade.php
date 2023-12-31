@forelse ($new_upcoming_sessions as $key => $upcoming_session)
    <div class="col-md-12">
        <div class="activityCard">
            <div class="dateWrap">
                <h2>
                    {{ $upcoming_session[0]->converted_time->format('d')}}
                    <span>{{ $upcoming_session[0]->converted_time->format('M') }}</span>
                </h2>
            </div>
            <div class="content">
                <div>
                    <h3>{{ $upcoming_session[0]->session_type }}</h3>
                    <small>Attendant(s): <strong>{{ count($upcoming_session) }}</strong></small>
                    <br>
                    @foreach($upcoming_session as $key => $upcoming_session[0])
                        <small> - {{ $upcoming_session[0]["customer"]->first_name.' '.$upcoming_session[0]["customer"]->last_name }}</small>
                        <br>
                    @endforeach

                    @if(isset($upcoming_session[0]->request_session) && $upcoming_session[0]->request_session->status === 'pending')
                        <span class="badge badge-danger">Applied for reschedule</span>
                    @else
                        @if($upcoming_session[0]->status == "completed")
                            <span class="badge badge-success">{{$upcoming_session[0]->formatted_status}}</span>
                        @elseif($upcoming_session[0]->status == "re-scheduled")
                            <span class="badge badge-warning">{{$upcoming_session[0]->formatted_status }}</span>
                        @elseif($upcoming_session[0]->status == "cancelled" || $upcoming_session[0]->status == "canceled")
                            <span class="badge badge-danger">Cancelled</span>
                        @elseif($upcoming_session[0]->status == "upcoming")
                            <span class="badge badge-primary">{{$upcoming_session[0]->formatted_status }}</span>
                        @endif
                    @endif

{{--                    @if($upcoming_session[0]->status == "completed")--}}
{{--                        <span class="badge badge-success mb-3">{{ ucfirst($upcoming_session[0]->status) }}</span>--}}
{{--                    @elseif($upcoming_session[0]->status == "re-scheduled")--}}
{{--                        <span class="badge badge-warning mb-3">{{ ucfirst($upcoming_session[0]->status) }}</span>--}}
{{--                    @elseif($upcoming_session[0]->status == "canceled")--}}
{{--                        <span class="badge badge-danger mb-3">{{ ucfirst($upcoming_session[0]->status) }}</span>--}}
{{--                    @elseif($upcoming_session[0]->status == "upcoming")--}}
{{--                        <span class="badge badge-primary mb-3">{{ ucfirst($upcoming_session[0]->status) }}</span>--}}
{{--                    @endif--}}

                </div>
                <div class="btnWrap">
                    <span>{{ $upcoming_session[0]->converted_time->format('h:i A')}}</span>

                    @if($upcoming_session[0]->status == "completed")
                        @if($upcoming_session[0]->demo_session_id != null)
                            @php $check = App\Models\Performance::where('demo_session_id',$upcoming_session[0]->demo_session_id)->first();
                            @endphp
                            @if($check == null)
                                <a href="{{ url('trainer/add-customer-performance/'.$upcoming_session[0]->id)}}">ADD
                                    PERFORMANCE</a>
                            @endif
                        @endif
                        <a href="{{ url('trainer/add-customer-details/'.$upcoming_session[0]->customer_id)}}">ADD Details</a>

                    @elseif($upcoming_session[0]->status == "upcoming")
                        <a href="#" data-toggle="modal" data-target="#joinMeetingModal{{$loop->iteration}}"
                           class="mb-3" style="width: 131px;!important;text-align: center;">JOIN</a>

                        @if(empty($upcoming_session[0]->request_session))
                            <a href="#" data-toggle="modal" data-target="#rescheduleModal{{$loop->iteration}}">RE-SCHEDULE</a>
                        @endif
                    @else
                        <a href="#" data-toggle="modal" data-target="#joinMeetingModal{{$loop->iteration}}"
                           class="text-center" style="width: 131px;!important">JOIN</a>
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
                                    <h2 class="secHeading">{{ $upcoming_session[0]->session_type}}</h2>
                                    <div class="exerciseCard mb-0 bg-light">
                                        <a href="#" class="text-dark"
                                           style="background-color: #f8f9fa">{{ $upcoming_session[0]->notes }}</a>
                                    </div>
                                    <a target="blank" href="{{ $upcoming_session[0]->start_url }}" class="btnStyle">Join Now</a>
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
                                        <input type="hidden" name="request_by_timezone" id="request_by_timezone" value="{{ @$upcoming_session[0]->trainer->time_zone }}">
                                        <input type="hidden" name="request_by" value="trainer">
                                        <input type="hidden" name="session_id" value="{{ $upcoming_session[0]->id }}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Select Date</label>
                                                    <i class="fa-regular fa-calendar-days"
                                                       style="position: absolute;right:0;margin-top:44px;margin-right: 43px;"></i>

                                                    <input type="date" name="new_session_date"
                                                           class="form-control" required>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Select Time</label>
                                                    <i class="fa-regular fa-clock"
                                                       style="position: absolute;right:0;margin-top:44px;margin-right: 43px;"></i>

                                                    <input type="text" name="new_session_time" id="new_session_time"
                                                           class="form-control " required>

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
                                                    SESSION
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
    <h2 style="text-align: center;">No sessions available this month</h2>
@endforelse
<script>
    $('[name="new_session_time"]').clockpicker({
        autoclose: true,
        twelvehour: true
    });
</script>
