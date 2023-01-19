@extends('layouts.trainer')
@section('page-title')
Customer Details
@endsection
@section('content')
<main>
    <div class="content-wrap">
        <div class="row">
            <div class="col-md-6">
                <h2 class="secHeading">Customer Details</h2>
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
                            <th><span>Time Zone</span></th>
                            <th><span>Time</span></th>
                            <th><span>Training Type</span></th>
                            <th><span>Action</span></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($details as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item["customers"]->first_name.' '.$item["customers"]->last_name}}</td>
                                <td>{{ $item["customers"]->email }}</td>
                                <td>{{ $item->time_band }}</td>
                                <td>{{ $item->detail_time }}</td>
                                <td>{{ $item->training_type }}</td>
                                <td>
                                    <button type="button" class="btn btnStyle" data-toggle="modal" data-target="#exampleModal{{$loop->iteration}}">
                                       View Detail
                                    </button>
                                </td>
                            </tr>
                            <!-- Button trigger modal -->

                            @php 
                                $fit_type = json_decode($item->fitness_type);
                                $inj      = json_decode($item->injuries);
                                $med      = json_decode($item->med_conditions);
                                $on_med   = json_decode($item->on_medication);
                            @endphp
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{$loop->iteration}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">DETAIL</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <p style="margin-bottom: 5px"><strong>=> Owns Fitness Tracker:</strong>{{ $item->owns_fitness_tracker }}</p>
                                    <p style="margin-bottom: 5px"><strong>=> Assigned Trainer:</strong> {{ $item->trainer_assigned }}</p>
                                    <p style="margin-bottom: 5px"><strong>=> Total Sessions in Week:</strong> {{ $item->total_sessions_in_week }}</p>
                                    <p style="margin-bottom: 5px"><strong>=> Fitness Type:</strong></p>
                                    <ul style="list-style-type:disc;margin-left: 55px;margin-top: 0px;">
                                        @forelse ($fit_type as $items)
                                            <li>{{ $items }}</li>
                                        @empty
                                        @endforelse
                                    </ul>
                                    <p style="margin-bottom: 5px"><strong>=> Period:</strong> {{ @$item->period }}</p>
                                    <p style="margin-bottom: 5px"><strong>=> Workout Experience:</strong> {{ @$item->workout_experience }}</p>
                                    <p style="margin-bottom: 5px"><strong>=> Life Style:</strong> {{ $item->life_style }}</p>
                                    <p style="margin-bottom: 5px"><strong>=> Focus Of Workout:</strong> {{ $item->focus_of_workout }}</p>
                                    <p style="margin-bottom: 5px"><strong>=> Workout Types:</strong> {{ $item->workout_type }}</p>
                                    <p style="margin-bottom: 5px"><strong>=> Injuries:</strong> </p>
                                    <ul style="list-style-type:disc;margin-left: 55px;margin-top: 0px;">
                                        @forelse ($inj as $items)
                                            <li>{{ $items }}</li>
                                        @empty
                                        @endforelse
                                    </ul>
                                    <p ><strong>Med Condition:</strong></p>
                                    <ul style="list-style-type:disc;margin-left: 55px;margin-top: 0px;">
                                        @forelse ($med as $items)
                                            <li>{{ $items }}</li>
                                        @empty
                                            
                                        @endforelse
                                    </ul>
                                    <p ><strong>=> On Medication:</strong></p>
                                    <ul style="list-style-type:disc;margin-left: 55px;margin-top: 0px;">
                                        @forelse ($on_med as $items)
                                            <li>{{ $items }}</li>
                                        @empty
                                            
                                        @endforelse
                                    </ul>
                                    <p style="margin-bottom: 5px"><strong>=> Medical Condition:</strong> {{ $item->medical_condition }}</p>
                                </div>
                            </div>
                            </div>
                        </div>
                        @empty
                        <h2 style="text-align: center">No Customer Details Available..!!</h2>
                        @endforelse

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
        // $(document).ready(function(){
        //     $('.add-review').click(function(){
                
        //         var trainer_id         = $(this).data('trainer_id');
        //         var session_id         = $(this).data('session_id');
        //         var cust_to_trainer_id = $(this).data('cust_to_trainer_id');

        //         $('#trainer_id').val(trainer_id);
        //         $('#session_id').val(session_id);
        //         $('#cust_to_trainer_id').val(cust_to_trainer_id);

        //         $('#exampleModal').modal('show');
        //     })

        //     $('.cancel-session').click(function() {
        //         var cust_to_trainer_id = $(this).data('cust_to_trainer_id');
        //         if (confirm("Are you sure you want to cancel this session?")) {
        //             event.preventDefault();
        //             $('#customer_to_trainer_id').val(cust_to_trainer_id);
        //             document.getElementById('cancelSession').submit();
        //         }
        //     })

        // })
    </script>
@endsection