@extends('layouts.admin-portal')
@section('page-title')
Edit FAQS
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-12">            
            <div class="card-body">               
                <form action="{{ route('faq.update',$content->id) }}" method="POST" >
                    @csrf
                    @method('PUT') 
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Faq Heading</label>
                                <input required type="text" class="form-control" name="heading" value="{{ $content->heading ?? " "}}">
                                
                                @error('category_id')
                                <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                      
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Faq Content</label>
                                <textarea required id="content" name="content" rows="8" cols="50" class="ckeditor form-control">{{ $content->content ?? " "}}</textarea>

                            </div>
                        </div>
                       
                    </div>
                  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                <a href="{{ url('admin/faq') }}" class="btn btn-secondary">Cancel</a>
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