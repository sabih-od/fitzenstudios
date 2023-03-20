
@php
    $cust_id       = App\Models\Customer::where('user_id', Auth::user()->id)->pluck('id')->first();
    $check_request = App\Models\BookDemoSession::where('customer_id', $cust_id)->first();
    $check_contract = App\Models\Contract::where('customer_id', $cust_id)->first();
@endphp
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <a class="navbar-brand" href="{{url('customer/dashboard')}}">
                    <img src="{{ asset('themes/customer/assets/images/logo.png') }}" class="img-fluid" alt="">
                </a>
                <div class="nav">
                    <a class="nav-link" href="{{url('customer/dashboard')}}">
                        <div class="sb-nav-link-icon">
                            <img src="{{ asset('themes/customer/assets/images/dashboard.png') }}" alt=""></div>
                            Dashboard
                    </a>
                    <a class="nav-link" href="{{ url('customer/sessions')}}">
                        <div class="sb-nav-link-icon">
                            <img src="{{ asset('themes/customer/assets/images/performance.png') }}" alt="">
                        </div>
                        Sessions
                    </a>
                    @if($check_request ==  null)
                        <a class="nav-link" href="{{url('book-demo')}}">
                            <div class="sb-nav-link-icon">
                                <img src="{{ asset('themes/customer/assets/images/performance.png') }}" alt="">
                            </div>
                            Book Demo
                        </a>
                    @endif
                    <a class="nav-link" href="{{ route('payments')}}">
                        <div class="sb-nav-link-icon">
                            <img src="{{ asset('themes/customer/assets/images/invoice.png') }}" alt="">
                        </div>
                        Invoices & Payment
                    </a>

                    <a class="nav-link" href="{{url('customer/profile')}}">
                        <div class="sb-nav-link-icon"><img src="{{ asset('themes/customer/assets/images/person.png') }}" alt=""></div>
                        Profile
                    </a>

                    @if(@$check_request->status == "completed" && $check_contract == null)

                        <a class="nav-link" href="{{url('customer/contract')}}">
                            <div class="sb-nav-link-icon"><img src="{{ asset('themes/customer/assets/images/invoice.png') }}" alt=""></div>
                            Contract
                        </a>
                    @endif
                </div>
            </div>
            <!-- <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
            </div> -->
        </nav>
    </div>
