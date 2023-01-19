@extends('layouts.admin-portal')
@section('page-title')
    Privacy Policy CMS
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-12">
                <div class="card-body">
                    <form action="{{ route('privacypolicy.update',1) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="innerWrap">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 style="text-align: center"><strong>Privacy Policy Banner</strong></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Banner Heading</label>
                                        <input type="text" class="form-control" name="banner_heading"
                                               value="{{ $content->banner_heading ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{-- <label for="">Banner Image</label>
                                        <input type="file" name="banner_image" class="form-control"><br>
                                        <img src="{{ asset($content->banner_image) }}" width="510px" height="auto" alt=""> --}}

                                        <div class="custom-file">
                                            <label for="logo">Banner Image</label><br>
                                            <input type="file" name="banner_image" id="customFile"
                                                   class="custom-file-input">
                                            <label class="custom-file-label" style="top:25px !important"
                                                   for="customFile">Choose Banner Image</label>
                                            <img src="{{ asset($content->banner_image) }}" width="500px" height="auto"
                                                 alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br><br><br>

                        <div class="row">
                            <div class="col-md-12">
                                <h2 style="text-align: center"><strong>Privacy Policy Section</strong></h2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Section Heading</label>
                                    <input type="text" class="form-control" name="section_heading"
                                           value="{{ $content->section_heading ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Section Content</label>
                                    <textarea id="section_content" name="section_content" rows="8" cols="50"
                                              class="ckeditor form-control">{{ $content->section_content }}</textarea>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <a href="{{ url('admin/products') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-warning">Update</button>
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
