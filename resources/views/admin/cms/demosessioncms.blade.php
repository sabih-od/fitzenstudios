@extends('layouts.admin-portal')
@section('page-title')
Demo Session CMS
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-12">            
            <div class="card-body">               
                <form action="{{ route('demosessioncms.update',1) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Heading</label>
                                <input type="text" class="form-control" name="heading" value="{{ $content->heading ?? '' }}">
                            </div>
                        </div>
                    </div>
           

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Content</label>
                                <textarea id="content" name="content" rows="6" cols="50" class="ckeditor form-control">{{ $content->content }}</textarea>
                                {{-- <input type="text" class="form-control" name="link_one" value="{{ $content->link_one ?? '' }}"> --}}
                            </div>
                        </div>
                    </div>
    
                  

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset($content->image) }}" width="200px" height="auto" alt="">
                        </div>
                    </div>
                
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                <a href="{{ url('admin/products') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-warning" >Update</button>
                            </div>
                        </div>
                    </div>
                </form>
                   
            </div>
        </div>
    </div>
</div>

@endsection
@push('custom-js-scripts')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
   
</script>
@endpush