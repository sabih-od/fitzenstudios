<!-- Begin: Footer -->

@php $content = App\Models\FooterCMS::find(1);@endphp
<footer style="background-image: url({{ asset($content->footer_image)}}) !important">
    <div class="container">
        <div class="row justify-content-lg-between justify-content-center">
            <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInLeft" data-wow-delay="1.2s">
                <a href="#"><img src="{{ asset($content->logo_image)}}" alt="logo"></a>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6 wow fadeInLeft" data-wow-delay="0.8s">
                <h3>{{ $content->heading_one }}</h3>
                <ul class="list-unstyled links">
                    <li><a href="{{ url('faqs')}}">{{ $content->link_one }}</a></li>
                    <li><a href="{{ url('privacy-policy')}}">{{ $content->link_two }}</a></li>
                    <li><a href="{{ url('terms-and-conditions')}}">{{ $content->link_three }}</a></li>
                    <li><a href="{{ url('contact-us')}}">{{ $content->link_four }}</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInLeft" data-wow-delay="0.6s">
                <h3>{{ $content->heading_two }}</h3>
                <form class="newsletterForm form-group" onsubmit="return false;">
                    <div class="newsLtrForm">
                        <input type="email" class="newLtrInput" placeholder="| info@youremail.com" id="email"
                               name="email" required>
                        <button type="submit" id="newsletterSubmit" style="color:#f7c345 !important"><i
                                style="color:#f7c345 !important" class="fas fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInLeft" data-wow-delay="0.4s">
                <h3>{{ $content->heading_three }}</h3>
                <ul class="list-unstyled socialIo">
                    <li><a href="{{ $content->facebook_link }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li><a href="{{ $content->twitter_link }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="{{ $content->instagram_link }}" target="_blank"><i class="fab fa-instagram"></i></a>
                    </li>
                    <li><a href="{{ $content->linkedin_link }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="copyRight">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 wow fadeInLeft" data-wow-delay="0.5s">
                    <p>{{ $content->note }}</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- END: Footer -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('assets/js/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/wow.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
<script src="{{ asset('assets/js/custom.min.js')}}"></script>

<script>
    $(document).ready(function () {
        $(document).on('click', "#newsletterSubmit", function () {
            var myemail = $("#email").val();
            var $this = $(this);

            $(this).prop('disabled', true);
            $('.newsletterForm > .alert').remove();
            $.ajax({
                url: '{{route("newsletter")}}',
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "email": myemail,
                },
                dataType: 'json',
                success: function (json) {
                    if (json['status'] == true) {
                        $("#email_newsletter").val('');
                        $this.parents('.newsletterForm').prepend('<div class="alert alert-success" style="padding:10px;margin-bottom:10px;">' + json['success'] + '</div>');
                    } else {
                        $this.prop('disabled', false);
                        $this.parents('.newsletterForm').prepend('<div class="alert alert-danger" style="padding:10px;margin-bottom:10px;">' + json['error'] + '</div>');
                    }
                }
            });
        })
    })
</script>
