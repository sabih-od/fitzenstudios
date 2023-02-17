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
                        <span class="badge badge-success mb-3">{{ ucfirst($item->status) }}</span>
                    @elseif($item->status == "re-scheduled")
                        <span class="badge badge-warning mb-3">{{ ucfirst($item->status) }}</span>
                    @elseif($item->status == "canceled")
                        <span class="badge badge-danger mb-3">{{ ucfirst($item->status) }}</span>
                    @elseif($item->status == "upcoming")
                        <span class="badge badge-primary mb-3">{{ ucfirst($item->status) }}</span>
                    @endif

                </div>
                <div class="btnWrap">
                    <span>{{  date('h:i A', strtotime($item->trainer_timezone_time)) }}</span>
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

                        <a href="#" data-toggle="modal" data-target="#joinMeetingModal{{$loop->iteration}}"class="mb-3"style="width: 131px;!important;text-align: center;">JOIN</a>
                        <a href="#" data-toggle="modal" data-target="#rescheduleModal{{$loop->iteration}}">RE-SCHEDULE.</a>
                    @else
                        <a href="#" data-toggle="modal" data-target="#joinMeetingModal{{$loop->iteration}}"class="text-center"style="width: 131px;!important">JOIN</a>
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
                                                    <i class="fa-regular fa-calendar-days"style="position: absolute;right:0;margin-top:44px;margin-right: 43px;"></i>

                                                    <input type="date" name="new_session_date"
                                                           class="form-control" required>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Select Time</label>
                                                    <i class="fa-regular fa-clock"style="position: absolute;right:0;margin-top:44px;margin-right: 43px;"></i>

                                                    <input type="time" name="new_session_time"
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
