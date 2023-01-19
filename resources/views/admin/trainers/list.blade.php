@extends('layouts.admin-portal')
@section('page-title')
    Trainer
@endsection
@section('style')
@endsection
@section('content')

    <div class="content-wrap">
        <div class="row">
            <div class="col-md-6">
                <h2 class="secHeading">Trainers</h2>
            </div>
            <div class="col-md-6 text-right">
                <a href="#" class="btnStyle addUserBtn addBtn">ADD Trainers</a>
            </div>
        </div>
        <div class="row align-items-center mt-4">
            @forelse ($trainers as $item)
                <div class="col-md-4 col-sm-6">
                    <div class="userCard">
                        <!-- Button trigger modal -->


                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Payment</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('add_trainer_payment')}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="trainer_id" value="{{ $item->id }}">
                                            <input type="file" name="slip" class="form-control">
                                            <button class="btnStyle">Add Payment</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="delBtn inrBtn">
                            <button data-toggle="modal" data-target="#exampleModal{{ $item->id }}">
                                <i class="fas fa-plus"></i>
                            </button>
                            <a href="{{ url('admin/edit-trainer/'.$item->id) }}">
                                <i class="far fa-edit"></i>
                            </a>
                            <button onclick="Delete({{$item->id}});">
                                <i class="fas fa-trash"></i>
                            </button>
                            <form action="{{route('trainer.destroy',$item->id)}}" method="POST" style="display: none;"
                                  id="delete-form-{{$item->id}}">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                            </form>
                        </div>
                        <a href="{{ url('admin/edit-trainer/'.$item->id) }}">
                            <div class="imgWrap">
                                <img src="{{ $item->photo ? asset($item->photo) : asset('assets/images/user1.jpg')}}"
                                     alt="">
                            </div>
                            <div class="content">
                                <h3>{{ $item->name.' '.$item->last_name }}</h3>
                                <p>{{ $item->email}}</p>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
            @endforelse

        </div>
    </div>
    @php $timezones = App\Models\TimeZone::all(); @endphp
    <!-- Modal -->
    <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHeaderText">Add New Trainer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('trainer.create') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="pkid" name="id" value="0"/>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="trainer_name">Name<span style="color: red">*</span></label>
                            <input type="text" id="trainer_name" name="name" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="trainer_name">Email<span style="color: red">*</span></label>
                            <input type="text" id="email" name="email" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label for="timezone">Time Zone<span style="color: red">*</span></label>
                            <select name="time_zone" id="time_zone" class="form-control" required>
                                <option value="">Select Time Zone</option>
                                @forelse ($timezones as $time)
                                    <option style="color: black !important" value="{{ $time->timezone_value }}">{{ $time->zone_name.' '.$time->time_zone }}</option>
                                @empty
                                @endforelse
                            </select>
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

        $('body').on('click', '.addBtn', function () {
            $("#pkid").val(0);
            $("#trainer_name").val('');
            $("#email").val('');
            $("#modalHeaderText").text('Add New Trainer');
            $('#AddModal').modal('show');
        });

        $('body').on('click', '.btnEdit', function () {
            var pkid = $(this).data('id');
            var name = $(this).data('name');
            var email = $(this).data('email');
            var row = $(this).closest("tr");

            $("#pkid").val(pkid);
            $("#trainer_name").val(name);
            $("#email").val(email);

            $("#modalHeaderText").text('Edit Trainer')
            $('#AddModal').modal('show');
        });

        function Delete(id) {
            if (confirm("Are you sure to delete?")) {
                event.preventDefault();
                document.getElementById('delete-form-' + id).submit();
            }
            return false;
        }

        // $(document).on('click', '.add_payment', function() {
        //     var trainer_id = $(this).data('id');
        //     $('#addPayment'+trainer_id).modal('show');
        // });

    </script>
@endpush
