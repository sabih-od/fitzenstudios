@extends('layouts.app')
@section('title', 'FAQS')

@section('css')
@endsection

@section('content')
<div class="main-slider">
    <img class="img-fluid w-100" src="{{ @$content->banner_image ? asset(@$content->banner_image) : asset('assets/images/faqBnnr.jpg')}}" alt="First slide">
    <div class="carousel-caption">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="wow fadeInLeftBig" data-wow-delay="0.6s">{{ @$content->banner_heading ?? "" }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Main Slider -->

<section class="faqSec">
    <div class="container">
        <div class="row">
            <div class="col-md-12 wow fadeInUp" data-wow-delay="1.5s">

                {{-- <div class="title text-center mx-auto wow fadeInUp" data-wow-delay="0.4s">
                    <span>CONTACT US</span>
                    <h2>Contact Form</h2>
                </div> --}}

                <div class="faq">
                    <div id="accordion" class="accordionStyle">
                            {{-- @forelse ($faqs as $item)
                              
                            @empty  
                            @endforelse --}}


                            @forelse ($faqs as $item)
                                @if($loop->iteration == 1)
                                    <div class="card">
                                        <div class="card-header" id="headingOne{{ $loop->iteration }}">
                                            <button class="btn btn-link collapsed" data-toggle="collapse"
                                                data-target="#collapse{{ $loop->iteration }}" aria-expanded="true"
                                                aria-controls="collapse{{ $loop->iteration }}">{{ $item->heading }}<i class="fas fa-plus"></i></button>
                                        </div>
                                        <div id="collapse{{ $loop->iteration }}" class="collapse show" aria-labelledby="headingOne{{ $loop->iteration }}"
                                            data-parent="#accordion">
                                            <div class="card-body">
                                                {!! $item->content !!}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="card">
                                        <div class="card-header" id="headingTwelve{{$loop->iteration}}">
                                            <button class="btn btn-link collapsed" data-toggle="collapse"
                                                data-target="#collapseTwelve{{$loop->iteration}}" aria-expanded="false"
                                                aria-controls="collapseTwelve{{$loop->iteration}}">{{ $item->heading }}<i
                                                    class="fas fa-plus"></i></button>
                                        </div>
                                        <div id="collapseTwelve{{$loop->iteration}}" class="collapse" aria-labelledby="headingFour"
                                            data-parent="#accordion">
                                            <div class="card-body">
                                               {!! $item->content !!}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty  
                            @endforelse
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('includes.instagram')

@endsection

@section('js')
@endsection