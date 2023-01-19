@extends('layouts.admin-portal')
@section('page-title')
    Home Page CMS
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-12">
                <div class="card-body">
                    <form action="{{ route('homepage.update',1) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="innerWrap">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 style="text-align: center"><strong>Home Page Banner Section</strong></h2>
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
                                    <label for="manufacturer_id">Banner Sub-Heading</label>
                                    <input type="text" class="form-control" name="banner_sub_heading"
                                           value="{{ $content->banner_sub_heading ?? '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Banner Content</label>
                                        <textarea id="banner_content" name="banner_content" rows="4" cols="50"
                                                  class="ckeditor  form-control">{{ $content->banner_content }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <div class="custom-file">
                                            <label for="logo">Banner Image</label><br>
                                            <input type="file" name="banner_image" id="banner_image"
                                                   class="custom-file-input">
                                            <label class="custom-file-label" for="banner_image">Choose file</label>
                                            <img src="{{ asset($content->banner_image) }}" width="500px" height="auto"
                                                 alt="">
                                        </div>
                                        {{-- <label for="">Banner Image</label>
                                        <input type="file" name="banner_image" class="custom-file-input">
                                        <img src="{{ asset($content->banner_image) }}" width="500px" height="auto" alt=""> --}}
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 style="text-align: center"><strong>Home Page About Us Section</strong></h2>
                                    <hr>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Aboutus Heading</label>
                                        <input type="text" class="form-control" name="about_heading"
                                               value="{{ $content->about_heading ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="manufacturer_id">Aboutus Sub-Heading</label>
                                    <input type="text" class="form-control" name="about_sub_heading"
                                           value="{{ $content->about_sub_heading ?? '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">About Us Content</label>
                                        <textarea id="about_content" name="about_content" rows="6" cols="50"
                                                  class="ckeditor form-control">{{ $content->about_content }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <label for="logo">Banner Image</label><br>
                                            <input type="file" name="about_image" id="about_image"
                                                   class="custom-file-input">
                                            <label class="custom-file-label" for="about_image">Choose file</label>
                                            <img src="{{ asset($content->about_image) }}" width="500px" height="340px"
                                                 alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 style="text-align: center"><strong>Home Page Categories Section</strong></h2>
                                    <hr>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Categories Heading</label>
                                        <input type="text" class="form-control" name="categories_heading"
                                               value="{{ $content->categories_heading ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="manufacturer_id">Categories Sub-Heading</label>
                                    <input type="text" class="form-control" name="categories_sub_heading"
                                           value="{{ $content->categories_sub_heading ?? '' }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Categories Content One</label>
                                        <textarea id="categories_content_one" name="categories_content_one" rows="6"
                                                  cols="50"
                                                  class="ckeditor form-control">{{ $content->categories_content_one }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="categories_image_one">Categories Image One</label>
                                        <input type="file" name="categories_image_one" id="categories_image_one"
                                               class="form-control"><br>
                                        <img src="{{ asset($content->categories_image_one) }}" width="500px"
                                             height="300px"
                                             alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Categories Content Two</label>
                                        <textarea id="categories_content_two" name="categories_content_two" rows="6"
                                                  cols="50"
                                                  class=" ckeditor form-control">{{ $content->categories_content_two }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Categories Image Two</label>
                                        <input type="file" name="categories_image_two" class="form-control"><br>
                                        <img src="{{ asset($content->categories_image_two) }}" width="500px"
                                             height="300px"
                                             alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Categories Content Three</label>
                                        <textarea id="categories_content_three" name="categories_content_three" rows="6"
                                                  cols="50"
                                                  class="ckeditor form-control">{{ $content->categories_content_three }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Categories Image Three</label>
                                        <input type="file" name="categories_image_three" class="form-control"><br>
                                        <img src="{{ asset($content->categories_image_three) }}" width="500px"
                                             height="300px" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Categories Content Four</label>
                                        <textarea id="categories_content_four" name="categories_content_four" rows="6"
                                                  cols="50"
                                                  class="ckeditor form-control">{{ $content->categories_content_four }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Categories Image Four</label>
                                        <input type="file" name="categories_image_four" class="form-control"><br>
                                        <img src="{{ asset($content->categories_image_four) }}" width="500px"
                                             height="300px"
                                             alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Categories Content Five</label>
                                        <textarea id="categories_content_five" name="categories_content_five" rows="6"
                                                  cols="50"
                                                  class="ckeditor form-control">{{ $content->categories_content_five }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Categories Image Five</label>
                                        <input type="file" name="categories_image_five" class="form-control"><br>
                                        <img src="{{ asset($content->categories_image_five) }}" width="500px"
                                             height="300px"
                                             alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Categories Content Six</label><br>
                                        <textarea id="categories_content_six" name="categories_content_six" rows="6"
                                                  cols="50"
                                                  class="ckeditor form-control">{{ $content->categories_content_six }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Categories Image Six</label>
                                        <input type="file" name="categories_image_six" class="form-control">
                                        <img src="{{ asset($content->categories_image_six) }}" width="500px"
                                             height="300px"
                                             alt="">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 style="text-align: center"><strong>Home Page WorkOut Section</strong></h2>
                                    <hr>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">WorkOut Heading</label>
                                        <input type="text" class="form-control" name="workout_heading"
                                               value="{{ $content->workout_heading ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="manufacturer_id">WorkOut Sub-Heading</label>
                                    <input type="text" class="form-control" name="workout_sub_heading"
                                           value="{{ $content->workout_sub_heading ?? '' }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">WorkOut URL One</label>
                                        <input type="text" class="form-control" name="workout_url_one"
                                               value="{{ $content->workout_url_one ?? '' }}">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">WorkOut Image One</label>
                                        <input type="file" name="workout_image_one" class="form-control">
                                        <img src="{{ asset($content->workout_image_one) }}" width="150px" height="120px"
                                             alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">WorkOut URL Two</label>
                                        <input type="text" class="form-control" name="workout_url_two"
                                               value="{{ $content->workout_url_two ?? '' }}">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">WorkOut Image Two</label>
                                        <input type="file" name="workout_image_two" class="form-control">
                                        <img src="{{ asset($content->workout_image_two) }}" width="150px" height="120px"
                                             alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">WorkOut URL Three</label>
                                        <input type="text" class="form-control" name="workout_url_three"
                                               value="{{ $content->workout_url_three ?? '' }}">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">WorkOut Image Three</label>
                                        <input type="file" name="workout_image_three" class="form-control">
                                        <img src="{{ asset($content->workout_image_three) }}" width="150px"
                                             height="120px"
                                             alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">WorkOut URL Four</label>
                                        <input type="text" class="form-control" name="workout_url_four"
                                               value="{{ $content->workout_url_four ?? '' }}">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">WorkOut Image Four</label>
                                        <input type="file" name="workout_image_four" class="form-control">
                                        <img src="{{ asset($content->workout_image_four) }}" width="150px"
                                             height="120px"
                                             alt="">
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 style="text-align: center"><strong>Home Page Testimonials Section</strong></h2>
                                    <hr>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Testimonials Heading</label>
                                        <input type="text" class="form-control" name="testimonial_heading"
                                               value="{{ $content->testimonial_heading ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="manufacturer_id">Testimonials Sub-Heading</label>
                                    <input type="text" class="form-control" name="testimonial_sub_heading"
                                           value="{{ $content->testimonial_sub_heading ?? '' }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Testimonials Author One</label>
                                        <input type="text" class="form-control" name="testimonial_author_one"
                                               value="{{ $content->testimonial_author_one ?? '' }}">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Testimonials Comment One</label>
                                        <textarea id="testimonial_content_one" name="testimonial_content_one" rows="6"
                                                  cols="50"
                                                  class="ckeditor form-control">{{ $content->testimonial_content_one }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Testimonials Author Two</label>
                                        <input type="text" class="form-control" name="testimonial_author_two"
                                               value="{{ $content->testimonial_author_two ?? '' }}">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Testimonials Comment Two</label>
                                        <textarea id="testimonial_content_two" name="testimonial_content_two" rows="6"
                                                  cols="50"
                                                  class="ckeditor form-control">{{ $content->testimonial_content_two }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Testimonials Author Three</label>
                                        <input type="text" class="form-control" name="testimonial_author_three"
                                               value="{{ $content->testimonial_author_three ?? '' }}">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Testimonials Comment Three</label>
                                        <textarea id="testimonial_content_three" name="testimonial_content_three"
                                                  rows="6"
                                                  cols="50"
                                                  class="ckeditor form-control">{{ $content->testimonial_content_three }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <h2 style="text-align: center"><strong>Home Page Instagram Section</strong></h2>
                                <hr>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Instagram Image One</label>
                                <input type="file" name="gallery_image_one" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <img src="{{ asset($content->gallery_image_one) }}" width="150px" height="120px" alt="">
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Instagram Image Two</label>
                                <input type="file" name="gallery_image_two" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <img src="{{ asset($content->gallery_image_two) }}" width="150px" height="120px" alt="">
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Instagram Image Three</label>
                                <input type="file" name="gallery_image_three" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <img src="{{ asset($content->gallery_image_three) }}" width="150px" height="120px"
                                     alt="">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Instagram Image Four</label>
                                <input type="file" name="gallery_image_four" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <img src="{{ asset($content->gallery_image_four) }}" width="150px" height="120px"
                                     alt="">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Instagram Image Five</label>
                                <input type="file" name="gallery_image_five" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <img src="{{ asset($content->gallery_image_five) }}" width="150px" height="120px"
                                     alt="">
                            </div>
                        </div>

                        <br>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <a href="{{ url('admin/dashboard') }}" class="btn btn-secondary">Cancel</a>
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
