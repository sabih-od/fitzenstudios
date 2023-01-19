<?php $activePage = Request::segment(2); ?>
  <!-- Bootstrap CSS CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  @php $content = App\Models\HeaderCMS::find(1);@endphp
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
      <div class="sidebar-brand-icon" >
        {{-- <img src="{{asset('themes/frontend/images/logo.png')}}"> --}}
      </div>
      {{-- <div class="sidebar-brand-text mx-3">Fitzen Studio</div> --}}
      <div class="sidebar-brand-text mx-3">
        <img src="{{ asset($content->logo)}}" width="120px" height="70px" alt="">
      </div>

    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item <?= ($activePage == 'dashboard') ? 'active' : ''; ?>">
      <a class="nav-link" href="{{ url('/admin/dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    {{-- <hr class="sidebar-divider"> --}}
    {{-- <div class="sidebar-heading">
      SETUPS
    </div> --}}
 
    <hr class="sidebar-divider">
    {{-- <div class="sidebar-heading">
      CMS
    </div> --}}

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
        aria-expanded="true" aria-controls="collapseBootstrap">
        <i class="far fa-fw fa-window-maximize"></i>
        <span>CMS</span>
      </a>
      <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded" style="background: #eeaa1b !important;">
          <a class="collapse-item" href="{{ url('admin/homepage/1/edit') }}">Home</a>
          <a class="collapse-item" href="{{ url('admin/contact/1/edit') }}">Contact Us</a>
          <a class="collapse-item" href="{{ url('admin/aboutus/1/edit') }}">About Us</a>
          <a class="collapse-item" href="{{ url('admin/privacypolicy/1/edit') }}">Privacy Policy</a>
          <a class="collapse-item" href="{{ url('admin/terms/1/edit') }}">Terms & Condition</a>
          <a class="collapse-item" href="{{ url('admin/footercms/1/edit') }}">Footer CMS</a>
          <a class="collapse-item" href="{{ url('admin/headercms/1/edit') }}">Header CMS</a>
          <a class="collapse-item" href="{{ url('admin/demosessioncms/1/edit') }}">Demo Session CMS</a>
          <a class="collapse-item" href="{{ url('admin/faq') }}">FAQS</a>
        
        </div>
      </div>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item <?= ($activePage == 'trainers') ? 'active' : ''; ?>">
      <a class="nav-link" href="{{ route('trainer.index') }}">
        <i class="fa fa-newspaper"></i>
        <span>Trainers</span></a>
    </li>
    
    <hr class="sidebar-divider">
    <li class="nav-item <?= ($activePage == 'session-request') ? 'active' : ''; ?>">
      <a class="nav-link" href="{{ url('admin/session-request') }}">
        <i class="fa fa-quote-left"></i>
        <span>Demo Session Requests</span></a>
    </li>
 
    <hr class="sidebar-divider">
    <li class="nav-item <?= ($activePage == 'customers') ? 'active' : ''; ?>">
      <a class="nav-link" href="{{ route('customer.index') }}">
        <i class="fa fa-newspaper"></i>
        <span>Customers</span></a>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item <?= ($activePage == 'newsletter') ? 'active' : ''; ?>">
      <a class="nav-link" href="{{ url('admin/newsletter') }}">
        <i class="fa fa-newspaper"></i>
        <span>Newsletters</span></a>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item <?= ($activePage == 'contact-inquiry') ? 'active' : ''; ?>">
      <a class="nav-link" href="{{ url('admin/contact-inquiry') }}">
        <i class="fas fa-list-alt"></i>
        <span>Contact Inquiry</span></a>
    </li>
    
    


    {{-- <li class="nav-item <?= ($activePage == 'categories') ? 'active' : ''; ?>">
      <a class="nav-link" href="javascript:;">
        <i class="fas fa-list-alt"></i>
        <span>CMS</span></a>
        <ul>
          <li><a class="nav-link" href="{{ url('admin/homepage/1/edit') }}">
            <i class="fas fa-list-alt"></i>
            <span>Home</span></a></li>
        </ul>
    </li> --}}
    {{-- <li class="nav-item <?= ($activePage == 'testimonials') ? 'active' : ''; ?>">
      <a class="nav-link" href="/admin/testimonials">
        <i class="fa fa-quote-left"></i>
        <span>Testimonials</span></a>
    </li>
    <li class="nav-item <?= ($activePage == 'faqs') ? 'active' : ''; ?>">
      <a class="nav-link" href="/admin/faqs">
        <i class="fa fa-question-circle"></i>
        <span>FAQs</span></a>
    </li> --}}

  </ul>
  <!-- Sidebar -->
