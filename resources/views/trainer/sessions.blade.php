@extends('layouts.trainer')
@section('page-title')
    Session
@endsection
@section('content')
    <main>
        <div class="content-wrap">
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
                                <th><span>Customer Name</span></th>
                                <th><span>Customer Email</span></th>
                                <th><span>Session Date</span></th>
                                <th><span>Session Time</span></th>
                                <th><span>Time Zone</span></th>
                                <th><span>Update Status</span></th>
                                <th><span>Action</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($upcoming_sessions as $item)

                                <tr>
                                    <td><span>{{ $loop->iteration }}</span></td>
                                    <td>
                                        <span>{{ $item["customer"]["first_name"].' '.$item["customer"]["last_name"] }}</span>
                                    </td>
                                    <td><span>{{ $item["customer"]["email"] }}</span></td>


                                    <td><span>{{ date('d-m-Y', strtotime(@$item->trainer_timezone_date)) }}</span></td>
                                    <td><span>{{ date('h:i A', strtotime(@$item->trainer_timezone_date)) }}</span></td>
                                <!--<td><span>{{ $item->demo_session_id != null ? date('d-m-Y', strtotime(@$item["sessions"]["session_date"])) : date('d-m-Y', strtotime(@$item->trainer_timezone_date)) }}</span></td>-->
                                <!--<td><span>{{ $item->demo_session_id != null ? date('h:i A', strtotime(@$item["sessions"]["session_time"])) : date('h:i A', strtotime(@$item->trainer_timezone_time)) }}</span></td>-->
                                <!--<td><span>{{ @$item["sessions"]["time_zone"] }}</span></td>-->
                                    <td><span>{{ @$item->trainer->time_zone }}</span></td>
                                    <td>
                                        @if ($item->status == 'canceled')
                                            <button type="button" class="btn btn-danger btnStyle">
{{--                                                N/A--}}
                                                Not Avaiable
                                            </button>
                                        @else
                                            <span>
                                                <button type="button" class="btn btn-primary btnStyle"
                                                        data-toggle="modal"
                                                        data-target="#exampleModal{{ $loop->iteration }}">
                                                    Update Session Status
                                                </button>
                                            </span>
                                        @endif
                                    </td>


                                    {{-- @if($item->statusF
                                     == "completed" && $item->id != $item["reviews"]["cust_to_trainer_id"]) --}}
                                    @if($item->status == "completed")
                                        <td><a href="javascript:;" class="btn btn-success">Completed</a></td>
                                    @elseif($item->status == "upcoming" || $item->status == "re-scheduled")
                                        <td>
                                            {{-- <button class="btn btn-sm btn-danger cancel-session" onClick="Delete({{$item->id}});">
                                                Cancel Session
                                            </button> --}}
                                            <a href="javascript:;" data-cust_to_trainer_id="{{ $item->id }}"
                                               class="btn-sm btn btn-danger cancel-session">Cancel Session</a></td>
                                    @else
                                        <td>
                                            <a href="javascript:;" class="btn btn-danger">Cancelled</a>
                                        </td>
                                    @endif
                                </tr>

                                <div class="modal fade" id="exampleModal{{ $loop->iteration }}" tabindex="-1"
                                     role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('trainer/update-session-status') }}" method="POST">
                                                    @csrf
                                                    <input type="text" name="session_id" value="{{ $item->id }}">
                                                    <select name="status" class="form-control">
                                                        <option value="upcoming">Upcoming</option>
                                                        <option value="completed">Completed</option>
                                                        <option value="cancelled">Cancelled</option>
                                                    </select><br>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <h4 style="text-align: center;">No Sessions Available..!!</h4>
                                    </td>
                                </tr>
                            @endforelse


                            <form action="{{ url('trainer/cancel-session') }}" method="POST" id="cancelSession">
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('.add-review').click(function () {

                var trainer_id = $(this).data('trainer_id');
                var session_id = $(this).data('session_id');
                var cust_to_trainer_id = $(this).data('cust_to_trainer_id');

                $('#trainer_id').val(trainer_id);
                $('#session_id').val(session_id);
                $('#cust_to_trainer_id').val(cust_to_trainer_id);

                $('#exampleModal').modal('show');
            })

            $('.cancel-session').click(function () {
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
