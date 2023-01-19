@extends('layouts.admin-portal')
@section('page-title')
Footer CMS
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-12">            
            <div class="card-body">               
                <form action="{{ route('footercms.update',1) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <h2 style="text-align: center"><strong>Footer</strong></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h2 style="text-align: center"><strong>Footer Section One</strong></h2>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Heading One</label>
                                <input type="text" class="form-control" name="heading_one" value="{{ $content->heading_one ?? '' }}">
                            </div>
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
                                {{-- <textarea id="section_content" name="section_content" rows="8" cols="50" class="ckeditor form-control">{{ $content->section_content }}</textarea> --}}
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
                        <div class="col-md-12">
                            <h2 style="text-align: center"><strong>Footer Section Two</strong></h2>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Heading Two</label>
                                <input type="text" class="form-control" name="heading_two" value="{{ $content->heading_two ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h2 style="text-align: center"><strong>Footer Section Three</strong></h2>
                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Heading Three</label>
                                <input type="text" class="form-control" name="heading_three" value="{{ $content->heading_three ?? '' }}">
                                {{-- <textarea id="section_content" name="section_content" rows="8" cols="50" class="ckeditor form-control">{{ $content->section_content }}</textarea> --}}
                            </div>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Facebook Link</label>
                                <input type="text" class="form-control" name="facebook_link" value="{{ $content->facebook_link ?? '' }}">
                                {{-- <textarea id="section_content" name="section_content" rows="8" cols="50" class="ckeditor form-control">{{ $content->section_content }}</textarea> --}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Twitter Link</label>
                                <input type="text" class="form-control" name="twitter_link" value="{{ $content->twitter_link ?? '' }}">
                            </div>
                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Instagram Link</label>
                                <input type="text" class="form-control" name="instagram_link" value="{{ $content->instagram_link ?? '' }}">
                                {{-- <textarea id="section_content" name="section_content" rows="8" cols="50" class="ckeditor form-control">{{ $content->section_content }}</textarea> --}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">LinkedIn Link</label>
                                <input type="text" class="form-control" name="linkedin_link" value="{{ $content->linkedin_link ?? '' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Copyright Note</label>
                                <input type="text" class="form-control" name="note" value="{{ $content->note ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Logo Image</label>
                                <input type="file" name="logo_image" class="form-control">
                                <img src="{{ asset($content->logo_image) }}" width="200px" height="auto" alt="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Footer Background Image</label>
                                <input type="file" name="footer_image" class="form-control">
                                <img src="{{ asset($content->footer_image) }}" width="550px" height="auto" alt="">
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