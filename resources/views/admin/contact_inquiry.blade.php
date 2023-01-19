@extends('layouts.admin-portal')
@section('page-title')
    Contact Inquiries
@endsection
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@section('content')


    <div class="row">
        <div class="col-md-12">

            <div class="table-responsive">
                <table class="table" id="gridView">
                    <thead class="thead-light">
                    <th>#</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th width="15%">Action</th>
                    </thead>
                    <tbody>
                    @forelse ($contacts as $item)

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->first_name.' '.$item->last_name}}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->message }}</td>
                            <td>{{ date('d-m-Y',strtotime($item->created_at))}}</td>

                            <td>
                                <button class="btn btn-sm btn-danger" onclick="Delete('. {{$item->id}} .');">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <form action="{{url('admin/delete-contact-inquiry')}}" id="deleteRow" method="POST"
                                      style="display: none;"
                                >
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

@endsection

@push('custom-js-scripts')
    <script type="text/javascript">

        function Delete(id) {
            if (confirm("Are you sure to delete?")) {
                event.preventDefault();
                $('#deleteRow').submit();
                // document.getElementById('delete-form-' + id).submit();
            }
            return false;
        }

    </script>
@endpush
