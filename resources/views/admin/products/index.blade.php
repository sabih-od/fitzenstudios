@extends('layouts.admin')
@section('page-title')
Products
@endsection
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="text-right">
            <a href="{{ url('admin/products/create') }}" class="btn btn-primary">Add New</a>
        </div>
        <br />
        <div class="card">
            <div class="card-body">                
                <div class="">
                    <table class="table" id = "gridView">
                        <thead class="thead-light" >
                            <th >Manufacturer</th>
                            <th>Name</th>
                            <th>Price</th>                            
                            <th width= "15%">Action</th> 
                        </thead>
                        <tbody>
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
        
        table =  $('#gridView').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('/admin/products') }}",
            columns: [
                {data: 'manufacturer_name', name: 'manufacturer_name'},
                {data: 'name', name: 'name'},
                {data: 'price', name: 'price'},
                // {data: 'package_name', name: 'package_name'},
                // {data: 'active', name: 'active', orderable: false, searchable: false},
                 {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
        });       
       
    });

    function Delete(id){
    if (confirm("Are you sure to delete?")) {
        event.preventDefault(); 
        document.getElementById('delete-form-' + id).submit();
    }
    return false;
   }

</script>
@endpush