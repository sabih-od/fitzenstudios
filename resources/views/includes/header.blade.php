<!-- Begin: Header -->

@php $content = App\Models\HeaderCMS::find(1);@endphp
<header class="wow fadeInDown" data-wow-delay="0.5s">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset($content->logo)}}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars text-white"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item {{ Route::currentRouteNamed('home') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/') }}">{{ $content->link_one }}</a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed('about') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('about-us') }}">{{ $content->link_two }}</a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed('faqs') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('faqs') }}">{{ $content->link_three }}</a>
                    </li>
                    <li class="nav-item  {{ Route::currentRouteNamed('contactus') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('contact-us') }}">{{ $content->link_four }}</a>
                    </li>
                </ul>
                <div class="btn-group">
                    @if(!Auth::check())
                    <a href="{{ url('login')}}" class="themeBtn"><span></span>{{ $content->link_five }}</a>
                    <a href="{{ url('register')}}" class="themeBtn"><span></span>{{ $content->link_six }}</a>
                    @else
                        @if(Auth::user()->role_id == 1)
                            <a href="{{ url('admin/dashboard')}}" class="themeBtn"><span></span>DASHBOARD</a>
                        @elseif(Auth::user()->role_id == 2)
                            <a href="{{ url('customer/dashboard')}}" class="themeBtn"><span></span>DASHBOARD</a>
                        @elseif(Auth::user()->role_id == 3)
                            <a href="{{ url('trainer/dashboard')}}" class="themeBtn"><span></span>DASHBOARD</a>
                        @endif
                        <a class="themeBtn" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endif
                </div>
            </div>
        </nav>
    </div>
</header>
