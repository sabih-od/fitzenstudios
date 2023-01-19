@extends('layouts.admin-portal')
@section('page-title')
    Contact Us CMS
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-12">
                <div class="card-body">
                    <form action="{{ route('contact.update',1) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="innerWrap">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 style="text-align: center"><strong>Contact Us Banner</strong></h2>
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
                                        <input type="file" name="banner_image" class="form-control"> <br>
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
                                <h2 style="text-align: center"><strong>Contact Us Section</strong></h2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Section Heading</label>
                                    <input type="text" class="form-control" name="section_heading"
                                           value="{{ $content->section_heading ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Section Sub Heading</label>
                                    <input type="text" class="form-control" name="section_sub_heading"
                                           value="{{ $content->section_sub_heading ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Location Heading</label>
                                    <input type="text" class="form-control" name="location_heading"
                                           value="{{ $content->location_heading ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Location</label>
                                    <textarea id="location" name="location" rows="8" cols="50"
                                              class="form-control">{{ $content->location }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email Heading</label>
                                    <input type="text" class="form-control" name="email_heading"
                                           value="{{ $content->email_heading ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" class="form-control" name="email"
                                           value="{{ $content->email ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Phone Number Heading</label>
                                    <input type="text" class="form-control" name="phone_heading"
                                           value="{{ $content->phone_heading ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phone Number</label>
                                    <input type="text" class="form-control" name="phone"
                                           value="{{ $content->phone ?? '' }}">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Map Location</label>
                                    <textarea id="map" name="map" rows="6" cols="50"
                                              class="form-control">{{ $content->map }}</textarea>

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
