@extends('layouts.admin-portal')
@section('page-title')
    About Us CMS
@endsection



@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-12">
                <div class="card-body">
                    <form action="{{ route('aboutus.update',1) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="innerWrap">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 style="text-align: center"><strong>About Us Banner Section</strong></h2>
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
                            <br><br><br><br>

                            <div class="row">
                                <div class="col-md-12">
                                    <h2 style="text-align: center"><strong>About Us Page First Section</strong></h2>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Section One Heading</label>
                                        <input type="text" class="form-control" name="section_one_heading"
                                               value="{{ $content->section_one_heading ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Section One Content</label>
                                        <textarea id="section_one_content" name="section_one_content" rows="6" cols="50"
                                                  class="ckeditor form-control">{{ $content->section_one_content }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Section One Extra Content</label>
                                        <textarea id="section_one_extra_content" name="section_one_extra_content"
                                                  rows="6" cols="50"
                                                  class="ckeditor form-control">{{ $content->section_one_extra_content }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Section One Image</label>
                                        <input type="file" name="section_one_image" class="form-control">
                                        <img src="{{ asset($content->section_one_image) }}" width="550px" height="auto"
                                             alt="">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <h2 style="text-align: center"><strong>About Us Page Two Section</strong></h2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Section Two Heading</label>
                                    <input type="text" class="form-control" name="section_two_heading"
                                           value="{{ $content->section_two_heading ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Section Two Content</label>
                                    <textarea id="section_two_content" name="section_two_content" rows="6" cols="50"
                                              class="ckeditor form-control">{{ $content->section_two_content }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Section Two Image</label>
                                    <input type="file" name="section_two_image" class="form-control">
                                    <img src="{{ asset($content->section_two_image) }}" width="350px" height="325px"
                                         alt="">
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
