@extends('layouts.admin-portal')
@section('page-title')
FAQS
@endsection
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@section('content')


<div class="row">
    <div class="col-md-12">
        <form action="{{ url('admin/updateBannerFaq') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Banner Heading</label>
                        <input type="text" class="form-control" name="banner_heading" value="{{ @$content->banner_heading ?? ' ' }}">
                        
                        @error('banner_heading')
                        <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
              
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Banner Image</label>
                        <input type="file" name="banner_image" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset(@$content->banner_image) }}" alt="" width="500px" height="200px">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <button type="submit" class="btnStyle" >Update Banner</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-12">
        <div class="text-right">
            <a href="{{ url('admin/faq/create') }}" class="btnStyle">Add New FAQ</a>
        </div>
        <br />
        <div class="card">
            <div class="card-body">                
                <div class="">
                    <table class="table" id = "gridView">
                        <thead class="thead-light" >
                            <th >#</th>
                            <th>Heading</th>
                            <th>Content</th>                            
                            <th width= "15%">Action</th> 
                        </thead>
                        <tbody>
                            @forelse ($faqs as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->heading}}</td>
                                    <td>{!! $item->content !!}</td>
                                    <td>
                                        <a class="btn btn-sm btn-warning btnEdit" href ="{{ url('admin/faq/'.$item->id.'/edit') }}" >
                                           <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a>

                                        <button class="btn btn-sm btn-danger" onclick="Delete('. {{$item->id}} .');" > 
                                            <i class="fa fa-trash"></i>
                                        </button>               
                                        <form action="{{route('faq.destroy',$item->id)}}" id="deleteRow" method="POST" style="display: none;"
                                           >    
                                            @csrf                   
                                                                        
                                            <input type="hidden" name="_method" value="DELETE">                     
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

@endsection

@push('custom-js-scripts')
<script type="text/javascript">

//     $(document).ready(function () {
        
//         table =  $('#gridView').DataTable({
//             processing: true,
//             serverSide: true,
//             ajax: "{{ url('/admin/faq') }}",
//             columns: [
//                 {data: 'id', name: 'id'},
//                 {data: 'heading', name: 'heading'},
//                 {data: 'content', name: 'content'},
//                 {data: 'action', name: 'action', orderable: false, searchable: false},
//                 ],
//         });       
       
//     });

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