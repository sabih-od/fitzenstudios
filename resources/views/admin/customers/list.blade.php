@extends('layouts.admin-portal')
@section('page-title')
    Customers Schedule
@endsection

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="text-right">

            </div>
            <br/>
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <table class="table" id="gridView">
                            <thead class="thead-light">
                            <th>Customer</th>
                            <th>Trainer</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th width="15%">Action</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="assign_trainer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHeaderText">Assign Trainer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('customer.assignTrainer') }}" enctype="multipart/form-data"
                      id="assignTrainer">
                    @csrf
                    <input type="hidden" id="customer_id" name="customer_id" value="0"/>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="trainer_name">Trainer</label>
                            <select class="form-control" name="trainer_id" id="trainer_id">
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
                                    <input type="text" class="form-control" value="01/06/2020" id="simpleDataInput"
                                           name="trainer_date">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="clockPicker2">Time</label>
                            <div class="input-group clockpicker" id="clockPicker2">
                                <input type="text" class="form-control" name="trainer_time">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('custom-js-scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {

            table = $('#gridView').DataTable({
                processing: true,
                serverSide: true,

                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'trainer', name: 'trainer'},
                    {data: 'trainer_date', name: 'trainer_date'},
                    {data: 'trainer_time', name: 'trainer_time'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            });

            // Bootstrap Date Picker
            $('#simple-date1 .input-group.date').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: 'linked',
                todayHighlight: true,
                autoclose: true,
            });

            $('#clockPicker2').clockpicker({
                autoclose: true,
                twelvehour: true
            });

            $('#check-minutes').click(function (e) {
                e.stopPropagation();
                input.clockpicker('show').clockpicker('toggleView', 'minutes');
            });
        });


        $('body').on('click', '.addBtn', function () {
            $("#pkid").val(0);
            $("#trainer_name").val('');
            $("#modalHeaderText").text('Add New Trainer');
            $('#AddModal').modal('show');
        });

        $('body').on('click', '.btnEdit', function () {
            var pkid = $(this).data('id');
            var name = $(this).data('name');
            $("#pkid").val(pkid);
            $("#trainer_name").val(name);

            $("#modalHeaderText").text('Edit Trainer')
            $('#AddModal').modal('show');
        });

        function changeTrainer(id, thiss) {
            var date = $(thiss).data('date');
            var time = $(thiss).data('time');

            $('#customer_id').val(id);
            $('#trainer_date').val(date);
            $('#trainer_time').val(time);
            $('#assign_trainer').modal('show');
            // document.getElementById('delete-form-' + id).submit();
        }

        function Delete(id) {
            if (confirm("Are you sure to delete?")) {
                event.preventDefault();
                document.getElementById('delete-form-' + id).submit();
            }
            return false;
        }
    </script>
@endpush
