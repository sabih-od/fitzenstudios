@extends('layouts.admin-portal')
@section('page-title')
Demo Session Requests
@endsection
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@section('content')

<div class="row">
    <div class="col-md-12">
        <h2 class="secHeading">Session Requests </h2>
    </div>
    <div class="col-md-12">
 
        <div class="card">
            <div class="card-body">                
                <div class="">
                    <table class="table" id = "gridView">
                        <thead class="thead-light" >
                            <th >#</th>
                            <th >Customer</th>
                            <th>Session Date</th>
                            <th>Session Time</th>
                            <th>Goals</th>
                            <th>Message</th>
                            <th>Trainer</th>
                            <th>Status</th>      
                            <th width= "10%">Action</th> 
                        </thead>
                        <tbody>
                            @forelse ($demos as $item)
                               
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$item->Customer->first_name .' '. $item->Customer->last_name}}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->session_date))}}</td>
                                    <td>{{ $item->session_time }}</td>
                                    <td>{{ $item->goals }}</td>
                                    <td>{{ $item->message }}</td>
                                    <td>{{ isset($item->Customer->trainer) ? $item->Customer->trainer->name : '' }}</td>
                                    <td>{{ $item->status }}</td>
                                   

                                    <td>
                                        {{-- <button class="btn btn-sm btn-warning" onclick="changeTrainer({{ $item->customer_id }}, this)" data-name="{{ $item->first_name.' '.$item->last_name }}" data-id="{{ $item->id }}" data-date="{{ date('mm-dd-yyyy', strtotime($item->session_date)) }}" data-time="{{ $item->session_time }}" data-trainer="{{ isset($item->Customer->trainer) ? $item->Customer->trainer->trainer_id : 0 }}">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </button> --}}
                                        @if($item->status == "pending")
                                            <a href="{{ url('admin/demo-session/'.$item->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                
                                            </a> 
                                        @else
                                        <a href="javascript:;" class="btn btn-sm btn-warning">
                                            {{-- <i class="fa fa-plus" aria-hidden="true"></i> --}}
                                        </a> 
                                        @endif
                                        <button class="btn btn-sm btn-danger" onclick="Delete('{{$item->id}}');" > 
                                            <i class="fa fa-trash"></i>
                                        </button>               
                                        <form action="{{url('admin/delete-session-request')}}" id="deleteRow{{$item->id}}" method="POST" style="display: none;">    
                                            @csrf                              
                                            <input type="hidden" name="id" value="{{$item->id}}">                     
                                        </form>
                                    </td>
                                </tr>
                              
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
  <!-- Modal -->
  <div class="modal fade" id="assign_trainer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="modalHeaderText">Assign Trainer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form method="POST" action="{{ route('customer.assignTrainer') }}" enctype="multipart/form-data" id="assignTrainer">
            @csrf
            <input type="hidden" id="customer_id" name="customer_id" value="0" />
            <input type="hidden" id="session_id" name="session_id" value="0" />

            <div class="modal-body">
              
                <div class="form-group">
                    <label for="">Session Type</label>
                    <input type="text" class="form-control" name="session_type">
                </div>
                
                <div class="form-group">
                    <label for="trainer_name">Trainer</label>
                    <select class="form-control" name="trainer_id" id="trainer_id" required>
                        <option value="0">Select Trainer</option>
                        @foreach($trainers as $trainer)
                            <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="form-group" id="simple-date1">
                        <label for="simpleDataInput">Date</label>
                        <div class="input-group date">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                            <input type="date" class="form-control"  id="simpleDataInput" name="trainer_date" required>
                        </div>
                        {{-- <label for="">Date</label>
                        <input type="date" placeholder="Select Date" class="form-control" id="simpleDataInput" name="trainer_date"> --}}
                        
                        {{-- <input type="date" placeholder="Select Date" class="form-control" id="simpleDataInput" name="trainer_date"> --}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="clockPicker2">Time</label>
                    <div class="input-group clockpicker" id="clockPicker2">
                    <input type="time" class="form-control" name="trainer_time" id="trainer_time" required>                     
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                    </div>                      
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Additional Notes</label>
                        <textarea placeholder="Write Message" cols="30" rows="5" class="form-control" name="notes"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning">Save</button>
            </div>
        </form>
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
            autoclose: true
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