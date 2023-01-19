@extends('layouts.admin')
@section('page-title')
Categories
@endsection
<style>

    .tree li {
        list-style-type: none;
        margin: 0;
        padding: 10px 5px 0 5px;
        position: relative
    }

    .tree li::before, .tree li::after {
        content: '';
        left: -20px;
        position: absolute;
        right: auto
    }

    .tree li::before {
        border-left: 1px solid #999;
        bottom: 50px;
        height: 100%;
        top: 0;
        width: 1px
    }

    .tree li::after {
        border-top: 1px solid #999;
        height: 20px;
        top: 25px;
        width: 25px
    }

    .tree li span {
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border: 1px solid #999;
        border-radius: 5px;
        display: inline-block;
        padding: 3px 8px;
        text-decoration: none
    }

    .tree li.parent_li > span {
        cursor: pointer
    }

    .tree > ul > li::before, .tree > ul > li::after {
        border: 0
    }

    .tree li:last-child::before {
        height: 30px
    }

    .tree li.parent_li > span:hover, .tree li.parent_li > span:hover + ul li span {
        background: #eee;
        border: 1px solid #94a0b4;
        color: #000
    }
</style>

@section('content')


<div class="text-right">
    <button type="button" class="btn btn-primary addBtn" >
        Add New
    </button>
</div>

<br />
<div class="card">   
    <div class="card-body">
        <div class="tree ">
            <ul>
                @forelse($categories as $data)
                <li>
                    @if($data->parent_id==0)
                    <span >
                        <img src="/uploads/images/categories/{{$data->photo}}" height="50" width="50" />
                         {{$data->name??''}}                         
                    </span>
                    
                    <a class="btn btn-sm btn-primary btnAddSub" href="javascript:(void)" data-id="{{$data->id??''}}"> 
                        <i class="fa fa-plus"></i>
                    </a>  
                    <a class="btn btn-sm btn-warning btnEdit" href="javascript:(void)" data-id="{{$data->id??''}}"> 
                        <i class="fa fa-edit"></i>
                    </a>               
                    <a class="btn btn-sm btn-danger btnDelete" href="javascript:(void)" 
                        onclick="Delete({{ $data->id }});" > 
                        <i class="fa fa-trash"></i>
                    </a>               
                    <form action="{{ route('categories.destroy',$data->id) }}" method="POST" style="display: none;"
                        id="delete-form-{{ $data->id }}"  >                        
                        @csrf
                        @method('DELETE')                        
                    </form>
                    @endif
                    <ul>
                        @if($data->sub_category)  @foreach($data->sub_category as $child)
                        <li>
                            <span>
                                <img src="/uploads/images/categories/{{$child->photo}}" height="50" width="50" />
                                {{$child->name??''}}
                            </span>
                            <a class="btn btn-sm btn-warning btnEdit" href="javascript:(void)" data-id="{{$child->id??''}}"> 
                                <i class="fa fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger btnDelete" href="javascript:(void)" 
                                onclick="Delete({{ $child->id }});" > 
                                <i class="fa fa-trash"></i>
                            </a>               
                            <form action="{{ route('categories.destroy',$child->id) }}" method="POST" style="display: none;"
                                id="delete-form-{{ $child->id }}"  >                        
                                @csrf
                                @method('DELETE')                        
                            </form>                           
                        
                        </li>
                        @endforeach @endif
                        
                    </ul>
                </li>
                @empty
                <li>Record Not Found</li>
            @endforelse
            </ul>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalHeaderText">Add New Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="pkid" name="id" value="0" />
            <input type="hidden" id="parent_id" name="parent_id" value="0" />
            <div class="modal-body">                
                <div class="form-group">
                    <label for="logo">Name</label>
                    <input type="text" id = "txtName" name="name" class="form-control" required  />
                </div>
                <div class="form-group">
                    <div class="custom-file">
                    <label for="logo">Photo</label><br>
                    <input type="file" name="photo" id="customFile" class="custom-file-input">
                    <label class="custom-file-label" for="customFile">Choose file</label>
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
<script type="text/javascript">
    $(function () {
    $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
    $('.tree li.parent_li > span').on('click', function (e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
            children.hide('fast');
            $(this).attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
        } else {
            children.show('fast');
            $(this).attr('title', 'Collapse this branch').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
        }
        e.stopPropagation();
    });
});

    $('body').on('click', '.addBtn', function () {
        $("#pkid").val(0);
        $("#parent_id").val(0);
        $("#txtName").val('');
        $("#modalHeaderText").text('Add New Category');
        $('#AddModal').modal('show');
    });

    $('body').on('click', '.btnAddSub', function () {
        $("#pkid").val(0);
        $("#parent_id").val($(this).data('id'));
        $("#txtName").val('');
        $("#modalHeaderText").text('Add New Sub Category');
        $('#AddModal').modal('show');
    });

    $('body').on('click', '.btnEdit', function () {
        var pkid = $(this).data('id');
        $("#pkid").val(pkid);
        $.get("{{ route('categories.index') }}" +'/' + pkid +'/edit', function (data) {
           $('#txtName').val(data.name);
        });       
       
        $("#modalHeaderText").text('Edit Category')
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