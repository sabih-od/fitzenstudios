@extends('layouts.admin-portal')
@section('page-title')
Newsletters
@endsection

@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table" id = "gridView">
                <thead class="thead-light" >
                <th >#</th>
                <th>Email</th>
                <th>Date</th>
                <th width= "15%">Action</th>
                </thead>
                <tbody>
                @forelse ($newsletters as $item)

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ date('d-m-Y',strtotime($item->created_at))}}</td>
                        <td>
                            <button class="btn btn-sm btn-danger" onclick="Delete('. {{$item->id}} .');" >
                                <i class="fa fa-trash"></i>
                            </button>
                            <form action="{{url('admin/delete-newsletter')}}" id="deleteRow" method="POST" style="display: none;"
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

    function Delete(id){
    if (confirm("Are you sure to delete?")) {
        event.preventDefault();
        $('#deleteRow').submit();
        // document.getElementById('delete-form-' + id).submit();
    }
    return false;
   }

</script>
@endpush
