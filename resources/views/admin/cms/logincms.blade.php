@extends('layouts.admin-portal')
@section('page-title')
Login-CMS
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-12">            
            <div class="card-body">               
                <form action="{{ url('admin/update-login-cms') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <h2 style="text-align: center"><strong>Login Page Banner</strong></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Banner Heading</label>
                                <input type="text" class="form-control" name="banner_text" value="{{ $content->banner_text ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="custom-file">
                                    <label for="logo">Banner Image</label><br>
                                    <input type="file" name="banner_image" id="customFile" class="custom-file-input">
                                    <label class="custom-file-label" style="top:25px !important" for="customFile">Choose Banner Image</label>
                                    <img src="{{ asset($content->banner_image) }}" width="500px" height="auto" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
         
                    <div class="row" style="margin-top: 112px;">
                        <div class="col-md-12">
                            <div class="text-center">
                            
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
<script type="text/javascript">
   
</script>
@endpush