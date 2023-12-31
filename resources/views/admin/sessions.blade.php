@extends('layouts.admin-portal')
@section('page-title')
    Sessions
@endsection
@section('content')
    <main>
        <div class="content-wrap">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="secHeading">Sessions</h2>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{url('admin/create-session')}}" class="btnStyle mb-2">create-session</a>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped text-center">
                            <thead>
                            <tr class="thead-dark">
                                <th><span>No.</span></th>
                                <th><span>Customer Name</span></th>
                                <th><span>Trainer Name</span></th>
                                <th><span>Session Date</span></th>
                                <th><span>Session Time</span></th>
                                <th><span>Time Zone</span></th>
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
                                    <td><span>{{ $item["trainer"]["name"].' '.$item["trainer"]["last_name"] }}</span>
                                    </td>
                                    <td><span>{{ date('d-m-Y', strtotime(@$item->customer_timezone_date)) }}</span></td>
                                    <td><span>{{ date('h:i A', strtotime(@$item->trainer_time)) }}</span></td>
                                    <td><span>{{ @$item->timeZone->abbreviation ?? '---'  }}</span></td>
                                    @if($item->status == "completed")
                                        <td><a href="javascript:;" class="btn btn-success">Completed</a></td>
                                    @elseif($item->status == "upcoming" || $item->status == "re-scheduled")
                                        <td>
                                            {{-- <button class="btn btn-sm btn-danger cancel-session" onClick="Delete({{$item->id}});">
                                                Cancel Session
                                            </button> --}}
                                            <a href="javascript:;" data-cust_to_trainer_id="{{ $item->id }}"
                                               class="btn-sm btn btn-primary cancel-session">Cancel Session</a></td>
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
                            <form action="{{ url('admin/cancel-session') }}" method="POST" id="cancelSession">
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
@push('custom-js-scripts')
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
@endpush
