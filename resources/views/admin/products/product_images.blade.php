@extends('layouts.admin')
@section('page-title')
Product Images
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mt-3 tab-card">
            <div class="card-header tab-card-header">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="one-tab"  href="/admin/products/edit/{{$product->id}}" role="tab" aria-controls="One" aria-selected="true">Basic Details</a>
                    </li>                   
                    <li class="nav-item">
                        <a class="nav-link active" id="three-tab" href="/admin/product_images/{{$product->id}}" role="tab" aria-controls="Three" aria-selected="false">Images</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">                       
                    <div class="card">
                        <div class="card-body">
                            <h6 class="m-0 font-weight-bold text-primary">Primary Image</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    @if(isset($product->photo))
                                    <img src="{{ asset('uploads/images/products/'.$product->photo) }}" alt="" class="img img-thumbnail" width="300px" height="400px">
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$product->id}}" />
                                        <div class="form-group">
                                            <div class="custom-file">
                                            <label for="logo">Photo</label><br>
                                            <input type="file" name="photo" id="customFile" class="custom-file-input">
                                            <label class="custom-file-label" for="customFile" id = "lblFileUpload">Choose file</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="card">
                        <div class="card-body">
                            <h6 class="m-0 font-weight-bold text-primary">Additional Image</h6>
                            <form action="{{ route('additional_images') }}" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-8">                        
                                        @csrf
                                        <input type="hidden" name="id" value="{{$product->id}}" />
                                        <div class="form-group">
                                            <div class="custom-file">
                                            <label for="logo">Photo</label><br>
                                            <input type="file" name="photos[]" id="multiFile" class="custom-file-input" multiple >
                                            <label class="custom-file-label" for="multiFile">Choose multiple or single file</label>
                                            </div>
                                        </div>                                                  
                                    </div>
                                    <div class="col-md-4">  
                                        <button type="submit" class="btn btn-primary">Save</button> 
                                    </div>                    
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <table>
                                        <tbody>
                                            @foreach($product->product_images as $pi)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('uploads/images/products/'.$pi->photo) }}" 
                                                    alt="" class="img img-thumbnail" width="150px" height="150px"> 
                                                </td>   
                                                <td>
                                                    <form action="{{ route('deleteProdImage') }}" method="POST">                                     
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{$pi->id}}" />
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick = "return confirm('Are you sure to delete?')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>                                
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-js-scripts')
<script type="text/javascript">
    $(document).on('change','#customFile' , function(){
        var fileName = this.value;
        var lastRowIndex = fileName.lastIndexOf('\\');
        fileName = fileName.substring(lastRowIndex + Number(1), fileName.length);
        $("#lblFileUpload").html(fileName);
    });
</script>
@endpush