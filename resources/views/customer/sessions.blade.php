@extends('layouts.customer')
@section('page-title')
Sessions
@endsection

@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="secHeading">Sessions</h2>
                </div>
                <div class="col-md-6 text-right">
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped text-center">
                            <thead>
                            <tr class="thead-dark">
                                <th><span>No.</span></th>
                                <th><span>Name</span></th>
                                <th><span>Session Date</span></th>
                                <th><span>Session Time</span></th>
                                <th><span>Time Zone</span></th>
                                <th><span>Goals</span></th>
                                <th><span>Message</span></th>
                                <th><span>Action</span></th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($sessions as $item)
                                    <tr>
                                        <td><span>{{ $loop->iteration }}</span></td>
                                        <td><span>{{ $item->customer->first_name}}</span></td>
{{--                                        <td><span>{{ date('d-m-Y', strtotime(@$item->customer_timezone_date)) }}</span></td>--}}
{{--                                        <td><span>{{ date('h:i A', strtotime(@$item->customer_timezone_time)) }}</span></td>--}}
                                        <td><span>{{ date('d-m-y', strtotime(@$item->trainer_date)) }}</span></td>
                                        <td><span>{{ date('h:i A', strtotime(@$item->trainer_time)) }}</span></td>
                                        <td><span>{{ @$item->timeZone->abbreviation ?? '---'}}</span></td>
                                        <td><span>{{ $item["sessions"] != null ? $item["sessions"]["goals"] : $item->session_type }}</span></td>
                                        <td><span>{{ $item["sessions"] != null ? $item["sessions"]["message"] : $item->notes }}</span></td>

                                    <!--<td><span>{{ $item->demo_session_id != null ? date('d-m-Y', strtotime(@$item["sessions"]["session_date"])) : date('d-m-Y', strtotime(@$item->customer_timezone_date)) }}</span></td>-->
                                    <!--<td><span>{{ $item->demo_session_id != null ? date('h:i A', strtotime(@$item["sessions"]["session_time"])) : date('h:i A', strtotime(@$item->customer_timezone_time)) }}</span></td>-->
                                    {{--<td><span>{{@$item->abbreviation}}</span></td>--}}
                                        <!--<td><span>{{ @$item["sessions"]["time_zone"] }}</span></td>-->
                                        {{-- @if($item->status == "completed" && $item->id != $item["reviews"]["cust_to_trainer_id"]) --}}
                                        {{-- <button class="btn btn-sm btn-danger cancel-session" onClick="Delete({{$item->id}});">
                                                    Cancel Session
                                                </button> --}}

                                        @if($item["status"] == "completed")
                                            @php $check = App\Models\Performance::where('session_id',$item->id)->where('customer_id', $item->customer_id)->first(); @endphp
                                            @if($check != null)
                                                <td>
                                                    <a href="{{ url('customer/performance-detail/'.$item->customer_id) }}" class="btn-sm btn-warning">View Performance</a>
                                                    <a href="javascript:;" data-cust_to_trainer_id="{{ $item->id }}" data-trainer_id="{{ $item->trainer_id }}" data-session_id="{{ $item->demo_session_id }}" class="btn-sm btn-warning add-review">Add Review</a>
                                                </td>
                                            @else
                                                <td> <a href="javascript:;" data-cust_to_trainer_id="{{ $item->id }}" data-trainer_id="{{ $item->trainer_id }}" data-session_id="{{ $item->demo_session_id }}" class="btn-sm btnStyle add-review">Add Review</a></td>
                                            @endif
                                        @elseif($item["status"] == "upcoming" || $item["status"] == "re-scheduled")
                                            <td>
                                            <a href="javascript:;" data-cust_to_trainer_id="{{ $item->id }}" class="btn-sm btn btn-warning cancel-session">Cancel Session</a></td>
                                        @else
                                            <td>
                                                <a href="javascript:;" class="btn btn-danger">Cancelled</a>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <h4 style="text-align: center;">No Sessions Available..!!</h4>
                                        </td>
                                    </tr>
                                @endforelse

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Review</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('customer/add-review') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="session_id" id="session_id" value="">
                                                <input type="hidden" name="trainer_id" id="trainer_id" value="">
                                                <input type="hidden" name="cust_to_trainer_id" id="cust_to_trainer_id" value="">


                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input class="form-control" name="name" id="name" type="text" value="{{ Auth::user()->name }}" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Rating</label>
                                                    <select name="rating" id="rating" class="form-control" required>
                                                        <option value="1">1 Star</option>
                                                        <option value="2"> 2 Star</option>
                                                        <option value="3"> 3 Star</option>
                                                        <option value="4"> 4 Star</option>
                                                        <option value="5"> 5 Star</option>

                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Review</label>
                                                    <input class="form-control" name="review" type="text" placeholder="Review" required>
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" class="btnStyle" style="width:100%;">Review</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                    </div>
                                </div>
                                <form action="{{ url('customer/cancel-session') }}" method="POST" id="cancelSession">
                                    @csrf
                                    <input type="hidden" name="customer_to_trainer_id" id="customer_to_trainer_id" value="">
                                </form>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
<script type = "text/javascript">
    $(document).ready(function(){
        $('.add-review').click(function(){

            var trainer_id         = $(this).data('trainer_id');
            var session_id         = $(this).data('session_id');
            var cust_to_trainer_id = $(this).data('cust_to_trainer_id');

            $('#trainer_id').val(trainer_id);
            $('#session_id').val(session_id);
            $('#cust_to_trainer_id').val(cust_to_trainer_id);

            $('#exampleModal').modal('show');
        })

        $('.cancel-session').click(function() {
            var cust_to_trainer_id = $(this).data('cust_to_trainer_id');
            if (confirm("Are you sure you want to cancel this session?")) {
                event.preventDefault();
                $('#customer_to_trainer_id').val(cust_to_trainer_id);
                document.getElementById('cancelSession').submit();
            }
        })

    })
  </script>
@endsection
