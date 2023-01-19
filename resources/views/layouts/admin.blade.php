<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Iron Huntor Admin Panel">
  
  <title>Fitzen Studio Dashboard - @yield('page-title')</title>
  <link href="{{ asset('themes/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('themes/admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('themes/admin/css/ruang-admin.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('themes/admin/vendor/datatables/dataTables.bootstrap4.min.css')}}">
  <link href="{{ asset('themes/admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" >
  <link href="{{ asset('themes/admin/vendor/clock-picker/clockpicker.css') }}" rel="stylesheet">
  {{-- <meta name="csrf-token" content="{{ csrf_token() }}" /> --}}
</head>

<body id="page-top">
  <div id="wrapper">
   @include('layouts.includes.admin-sidebar')
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          {{-- <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button> --}}
          <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              {{-- <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px"> --}}
              <span class="ml-2 d-none d-lg-inline small" style="color: #fff !important;"><strong>{{ Auth::user()->name }}</strong></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                {{-- <a class="dropdown-item" href="{{ route('settings.index') }}">
                    <i class="fas fa-wrench fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <div class="dropdown-divider"></div> --}}

                <a class="dropdown-item" data-toggle="modal" data-target="#changePassword">
                <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                Change Password
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>
          </ul>
        </nav>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">@yield('page-title') </h1>
          </div>
          @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>aas
              {{ Session::get('success') }}
            </div>
          @endif
          <div class="alert alert-success alert-dismissible fade show" role="alert" id = "flashMsg" style="display:none">
            <div id = "flashMsgDiv"></div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @if (Session::has('error'))
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            {{ Session::get('error') }}
          </div>
          @endif

          @yield('content')
        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">

          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Password reset Modal -->
  <div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Password Reset</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('change.password') }}">
              @csrf

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>

                    <div class="col-md-6">
                        <input id="old_password" type="password" class="form-control" name="old_password" autocomplete="current-password">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" autocomplete="current-password">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>

                    <div class="col-md-6">
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" autocomplete="current-password">
                    </div>
                </div>
                <div class="pull-right">
                  <button type="submit" class="btn btn-primary">Update password</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('themes/admin/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('themes/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  {{-- <script src="{{ asset('themes/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('themes/admin/js/ruang-admin.min.js') }}"></script> --}}
  <script src="{{asset('themes/admin/vendor/datatables/jquery.dataTables.min.js')}}" ></script>
  <script src="{{asset('themes/admin/vendor/datatables/dataTables.bootstrap4.min.js')}}" ></script>
  <script src="{{asset('themes/admin/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{asset('themes/admin/vendor/clock-picker/clockpicker.js')}}"></script>
  {{-- <script src="{{asset('themes/admin/js/bootstrap-notify.js')}}" ></script> --}}

  @stack('custom-js-scripts')
  @yield('js')
</body>

</html>
