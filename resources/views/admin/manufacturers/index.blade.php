@extends('layouts.admin')
@section('page-title')
Manufacturers
@endsection
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="text-right">
            <button type="button" class="btn btn-primary addBtn" >
                Add New
            </button>
        </div>
        <br />
        <div class="card">
            <div class="card-body">                
                <div class="">
                    <table class="table" id = "gridView">
                        <thead class="thead-light" >
                            <th >Category</th>
                            <th>Name</th>                            
                            {{-- <th width= "5%">Active</th>--}}
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


<!-- Modal -->
<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalHeaderText">Add New Amenity</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="pkid" name="id" value="0" />
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Category</label>
                    <select class="js-example-basic-single form-control" id = "ddlCategories" name="category_id" style = "width:450" required>
                        <option value="">Please Select</option>
                        @if(!empty($categories))
                            @foreach($categories as $val)
                                @if($val->parent_id==0)
                                    <optgroup label="{{$val->name}}">
                                @endif
                                @if($val->sub_category)  
                                    @foreach($val->sub_category as $child)
                                        <option
                                            {{!empty($content->id) && $content->sub_category_id==$child->id?'selected':''}} value="{{$child->id??''}}">
                                            {{$child->name??''}}
                                        </option>                                    
                                    @endforeach 
                                @endif
                                </optgroup>
                            @endforeach 
                        @endif
                    </select>
                    @error('category_id')
                    <span style="color:red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="logo">Name</label>
                    <input type="text" id = "txtName" name="name" class="form-control" required  />
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" ></script>
<script type="text/javascript">

    $(document).ready(function () {
        
        table =  $('#gridView').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('/admin/manufacturers') }}",
            columns: [
                {data: 'category_name', name: 'category_name'},
                {data: 'name', name: 'name'},
                // {data: 'package_name', name: 'package_name'},
                // {data: 'active', name: 'active', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
        });
        
        //$('.js-example-basic-single').select2();
        $('#ddlCategories').select2();
    });
       

    $('body').on('click', '.addBtn', function () {
        $("#pkid").val(0);
        $("#txtName").val('');
        $("#modalHeaderText").text('Add New Manufacturer');
        $('#AddModal').modal('show');
    });

    $('body').on('click', '.btnEdit', function () {
        var pkid = $(this).data('id');
        $("#pkid").val(pkid);
        var row = $(this).closest("tr");
        $("#txtName").val(row.find("td:eq(1)").text());
        $("#ddlCategories option:contains(" + row.find("td:eq(0)").text() + ")")
        .attr('selected', 'selected').trigger('change');        
        
        $("#modalHeaderText").text('Edit Manufacturer')
        $('#AddModal').modal('show');
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