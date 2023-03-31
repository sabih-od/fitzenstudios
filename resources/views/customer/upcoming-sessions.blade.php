@forelse ($upcoming_sessions as $item)
    <div class="col-md-12">
        <div class="activityCard">
            <div class="dateWrap">
                <h2>{{ $item->converted_time->format('d') }}
                    <span>{{ $item->converted_time->format('M') }}</h2>
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
                    @if(isset($item->request_session) && $item->request_session->request_by === 'customer' && $item->request_session->status === 'pending')
                        <span class="badge badge-danger">Applied for reschedule</span>
                    @else
                        @if($item->status == "completed")
                            <span class="badge badge-success">{{$item->formatted_status}}</span>
                        @elseif($item->status == "re-scheduled")
                            <span class="badge badge-warning">{{$item->formatted_status }}</span>
                        @elseif($item->status == "cancelled" || $item->status == "canceled")
                            <span class="badge badge-danger">Cancelled</span>
                        @elseif($item->status == "upcoming")
                            <span class="badge badge-primary">{{$item->formatted_status }}</span>
                        @endif
                    @endif
                </div>
                <div class="btnWrap">
                    <span>{{$item->converted_time->format('h:i A')}}</span>
                    @if($item->status == "completed")
                        <a href="{{ url('customer/performance-detail/'.$item->id) }}">View Performance</a>
                    @elseif($item->status == "upcoming")
                        <a href="#" data-toggle="modal" data-target="#joinMeetingModal{{$loop->iteration}}"class="mb-2"style="width: 150px;">JOIN MEETING</a>
                        <a href="#" class="mb-2 cancel-session btn- btn-danger" data-cust_to_trainer_id="{{ $item->id }}">Cancel Session</a>
                    @elseif($item->status == "re-scheduled")
                        <a href="#"  data-toggle="modal" data-target="#joinMeetingModal{{$loop->iteration}}">JOIN MEETING</a>
                        <a href="javascript:;" class="cancel-session btn- btn-danger" data-cust_to_trainer_id="{{ $item->id }}">Cancel Session</a>
                    @endif

                    @if(isset($item->request_session) && $item->status !== 'canceled' || $item->status !== 'cancelled')
                        @php
                            $user_id     = Auth::user()->id;
                            $get_cust_id = App\Models\Customer::where('user_id',
                            $user_id)->pluck('id')->first();
                            $date = \Carbon\Carbon::parse($item->trainer_date.' '.$item->trainer_time);
                            $now  = \Carbon\Carbon::now();
                            $diff = $date->diffInHours($now);
                        @endphp

                        @if(empty($item->request_session) || !empty($item->request_session) && $item->request_session->request_by !== 'customer')
                            @if($diff >= 6)
                                <a href="#" data-toggle="modal" data-target="#rescheduleModal{{$loop->iteration}}"style="width: 150px;">RE-SCHEDULE</a>
                            @else
                                <a href="#" data-toggle="modal" data-target="#rescheduleMessage"class="">RE-SCHEDULE</a>
                        @endif
                    @endif
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
                                        <input type="hidden" name="request_by_timezone" id="request_by_timezone" value="{{ @$item->customer->time_zone }}">
                                        <input type="hidden" name="session_id" id="session_id"
                                               value="{{ $item->id }}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Select Date</label>
                                                    <i class="fa-regular fa-calendar-days"style="position: absolute;right:0;margin-top:44px;margin-right: 43px;"></i>

                                                    <input type="date" name="new_session_date"
                                                           id="new_session_date" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Select Time</label>
                                                    <i class="fa-regular fa-clock"style="position: absolute;right:0;margin-top:44px;margin-right: 43px;"></i>
                                                    <input type="text" name="new_session_time"
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
<script>
    $('#new_session_time').clockpicker({
        autoclose: true,
        twelvehour: true
    });
</script>
