@extends('layouts.admin-portal')
@section('page-title')
Re-Schedule Session Requests
@endsection
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@section('content')

<div class="row">
    <div class="col-md-12">
        <h2 class="secHeading">Re-Schedule Requests</h2>
    </div>
    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <div class="">
                    <table class="table" id = "gridView">
                        <thead class="thead-light" >
                            <th >#</th>
                            <th >Request By</th>
                            <th>Session Name</th>
                            <th>New Session Date</th>
                            <th>Time</th>
                            <th>Time Zone</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th width= "15%">Action</th>

                        </thead>
                        <tbody>
                            @forelse ($all_requests as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucfirst($item->request_by) }}</td>
                                    <td>{{ isset($item["sessions"][0]) ? $item["sessions"][0]->session_type : '---' }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->new_session_date))}}</td>
                                    <td>{{ date('h:i A', strtotime($item->new_session_time)) }}</td>
                                    <td>{{ $item->timeZone->abbreviation }}</td>

                                    <td>{{ $item->reason }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                       <!--<a href="{{ url('admin/approve-request/'.$item->id) }}" class="btn btn-success">Approve</a>-->
                                       <form action="{{ url('admin/approve-request/'.$item->id) }}" method="post">
                                            @csrf
                                             <input type="hidden" name="time_zone" value="{{ $item->timeZone->id }}">
                                             <input type="submit"value="Approve" class="btn btn-success">
                                        </form>
                                        <button class="btn btn-danger" onclick="Delete('{{$item->id}}');" >
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                        <form action="{{url('admin/delete-schedule-request')}}" id="deleteRow{{$item->id}}" method="POST" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}} ">
                                        </form>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="100%" class="text-center">
                                        No record found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('custom-js-scripts')
<script type="text/javascript">

    $(document).ready(function () {

        // Bootstrap Date Picker
        $('#simple-date1 .input-group.date').datepicker({
            format: 'yyyy-mm-dd',
            todayBtn: 'linked',
            todayHighlight: true,
            autoclose: true,
        });

        $('#clockPicker2').clockpicker({
            autoclose: true,
            twelvehour: true
        });

        $('#check-minutes').click(function(e){
            e.stopPropagation();
            input.clockpicker('show').clockpicker('toggleView', 'minutes');
        });
    });

    function changeTrainer(id, thiss){
        var date    = $(thiss).data('date');
        var time    = $(thiss).data('time');
        var trainer = $(thiss).data('trainer');
        var sessionid = $(thiss).data('id');
        // alert(trainer);
        $('#customer_id').val(id);
        $('#simpleDataInput').val(date);
        $('#trainer_time').val(time);
        $('#session_id').val(sessionid);
        $("#trainer_id option[value='" + trainer + "']").attr("selected","selected");

        $('#assign_trainer').modal('show');
        // document.getElementById('delete-form-' + id).submit();
    }

    function Delete(id){
        if (confirm("Are you sure to delete?")) {
            event.preventDefault();
            var delete_id = '#deleteRow'+id;
            // console.log(delete_id);
            $('#deleteRow'+id).submit();
            // document.getElementById('delete-form-' + id).submit();
        }
        return false;
    }

</script>
@endpush
