
@php $item = App\Models\Trainer::where('user_id', Auth::user()->id)->first(); @endphp
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <a class="navbar-brand" href="{{url('trainer/dashboard')}}">
                <img src="{{ asset('themes/customer/assets/images/logo.png') }}" class="img-fluid" alt="">
            </a>
            <div class="nav">
                <a class="nav-link" href="{{url('trainer/dashboard')}}">
                    <div class="sb-nav-link-icon">
                        <img src="{{ asset('themes/customer/assets/images/dashboard.png') }}" alt="">
                    </div>
                        Dashboard
                </a>
                <a class="nav-link" href="{{ url('trainer/performance')}}">
                    <div class="sb-nav-link-icon">
                        <img src="{{ asset('themes/customer/assets/images/performance.png') }}" alt="">
                    </div>
                    Performance
                </a>
                <a class="nav-link" href="{{ url('trainer/sessions')}}">
                    <div class="sb-nav-link-icon">
                        <img src="{{ asset('themes/customer/assets/images/performance.png') }}" alt="">
                    </div>
                    Sessions
                </a>
                {{-- <a class="nav-link" href="{{ route('cust_details')}}">
                    <div class="sb-nav-link-icon">
                        <img src="{{ asset('themes/customer/assets/images/performance.png') }}" alt="">
                    </div>
                    Customer Details
                </a> --}}

                <a class="nav-link" href="{{ url('trainer/payments') }}">
                    <div class="sb-nav-link-icon">
                        <img src="{{ asset('themes/customer/assets/images/invoice.png') }}" alt="">
                    </div>
                    Payment History
                </a>
                @if(!is_null($item))
                {{--                <a class="nav-link" href="{{url('trainer/profile')}}">--}}
                <a class="nav-link" href="{{url('trainer/profile/'.$item->id)}}">
                    <div class="sb-nav-link-icon"><img src="{{ asset('themes/customer/assets/images/person.png') }}" alt=""></div>
                    Profile
                </a>
                    @endif
            </div>
        </div>
    </nav>
</div>
