@extends('layouts.admin-portal')
@section('page-title')
Header CMS
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-12">            
            <div class="card-body">               
                <form action="{{ route('headercms.update',1) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <h2 style="text-align: center"><strong>Header</strong></h2>
                        </div>
                    </div>
           

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Link One</label>
                                <input type="text" class="form-control" name="link_one" value="{{ $content->link_one ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Link Two</label>
                                <input type="text" class="form-control" name="link_two" value="{{ $content->link_two ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Link Three</label>
                                <input type="text" class="form-control" name="link_three" value="{{ $content->link_three ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Link Four</label>
                                <input type="text" class="form-control" name="link_four" value="{{ $content->link_four ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Link Five</label>
                                <input type="text" class="form-control" name="link_five" value="{{ $content->link_five ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Link Six</label>
                                <input type="text" class="form-control" name="link_six" value="{{ $content->link_six ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Logo Image</label>
                                <input type="file" name="logo" class="form-control">
                                <img src="{{ asset($content->logo) }}" width="200px" height="auto" alt="">
                            </div>
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