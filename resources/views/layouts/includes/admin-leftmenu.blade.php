<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <a class="navbar-brand" href="{{url('admin/dashboard')}}">
                <img src="{{ asset('themes/customer/assets/images/logo.png') }}" class="img-fluid" alt="">
            </a>
            <div class="nav">
                <a class="nav-link" href="{{url('admin/dashboard')}}">
                    <div class="sb-nav-link-icon">
                        <img src="{{ asset('themes/customer/assets/images/dashboard.png') }}" alt="">
                    </div>
                        Dashboard
                </a>
                
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="far fa-fw fa-window-maximize"></i></div>
                    CMS
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">                        
                        <a class="nav-link" href="{{ url('admin/homepage/1/edit') }}">Home</a>
                        <a class="nav-link" href="{{ url('admin/contact/1/edit') }}">Contact Us</a>
                        <a class="nav-link" href="{{ url('admin/aboutus/1/edit') }}">About Us</a>
                        <a class="nav-link" href="{{ url('admin/privacypolicy/1/edit') }}">Privacy Policy</a>
                        <a class="nav-link" href="{{ url('admin/terms/1/edit') }}">Terms & Condition</a>
                        <a class="nav-link" href="{{ url('admin/footercms/1/edit') }}">Footer CMS</a>
                        <a class="nav-link" href="{{ url('admin/headercms/1/edit') }}">Header CMS</a>
                        <a class="nav-link" href="{{ url('admin/demosessioncms/1/edit') }}">Demo Session CMS</a>
                        <a class="nav-link" href="{{ url('admin/faq') }}">FAQS</a>
                        <a class="nav-link" href="{{ url('admin/login-cms') }}">Login CMS</a>
                        <a class="nav-link" href="{{ url('admin/signup-cms') }}">Signup CMS</a>
                    </nav>
                </div>
                <a class="nav-link" href="{{ route('trainer.index') }}">
                    <div class="sb-nav-link-icon">
                    <img src="{{ asset('themes/customer/assets/images/coach.png') }}" alt="">
                        </div>
                        <span> Trainers</span>
                </a>
                <a class="nav-link" href="{{ route('leads.index') }}">
                    <div class="sb-nav-link-icon">
                        <img src="{{ asset('themes/customer/assets/images/coach.png') }}" alt="">
                    </div>
                    <span> Leads</span>
                </a>


                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#SessionData" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="far fa-fw fa-window-maximize"></i></div>
                    Sessions
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>

                <div class="collapse" id="SessionData" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">                        
                        <a class="nav-link" href="{{ url('admin/sessions') }}">Sessions</a>
                        <a class="nav-link" href="{{ url('admin/session-request') }}">Demo Session Requests</a>
                        <a class="nav-link" href="{{ url('admin/reschedule-requests') }}">Re-Schedule Requests</a>
                    </nav>
                </div>
                
                <a class="nav-link" href="{{ route('customer.index') }}">
                    <div class="sb-nav-link-icon">
                    <img src="{{ asset('themes/customer/assets/images/person.png') }}" alt="">
                    </div>
                    <span>Customers</span>
                </a>
                <a class="nav-link" href="{{ url('admin/performance')}}">
                    <div class="sb-nav-link-icon">
                        <img src="{{ asset('themes/customer/assets/images/performance.png') }}" alt="">
                    </div>
                    Performance
                </a>
                <a class="nav-link" href="{{ url('admin/newsletter') }}">
                    <div class="sb-nav-link-icon">
                    <img src="{{ asset('themes/customer/assets/images/invoice.png') }}" alt="">
                    </div>
                    <span>Newsletters</span>
                </a>

                <a class="nav-link" href="{{ url('admin/contact-inquiry') }}">
                    <div class="sb-nav-link-icon">
                    <img src="{{ asset('themes/customer/assets/images/invoice.png') }}" alt="">
                    </div>
                    <span>Contact Inquiry</span>
                </a>
                <a class="nav-link" href="{{ url('/') }}">
                    <div class="sb-nav-link-icon">
                    <img src="{{ asset('themes/customer/assets/images/invoice.png') }}" alt="">
                    </div>
                    <span>Visit Website</span>
                </a>
                {{-- <a class="nav-link" href="{{ url('admin/contracts') }}">
                    <div class="sb-nav-link-icon">
                    <img src="{{ asset('themes/customer/assets/images/invoice.png') }}" alt="">
                    </div>
                    <span>Contracts</span>
                </a> --}}
            </div>
        </div>
        
        
    </nav>
</div>