<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Fitzen Studio - @yield('page-title')</title>

    <!-- Calandar CSS -->
    <link href="https://unpkg.com/@fullcalendar/core@4.3.0/main.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.css" rel="stylesheet" />
    <!-- Calandar CSS -->
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="{{ asset('themes/admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" >
    <link href="{{ asset('themes/admin/vendor/clock-picker/clockpicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('themes/admin/css/slick.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('themes/admin/css/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('themes/admin/css/slick-theme.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('themes/admin/css/styles.css') }}"  />
    <link rel="stylesheet" href="{{ asset('themes/admin/css/custom.min.css') }}"  />
    <link rel="stylesheet" href="{{ asset('themes/admin/css/responsive.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />


    @yield('style')
</head>

<body class="sb-nav-fixed">
<div id="layoutSidenav">
    @include('layouts.includes.admin-leftmenu')
  <div id="layoutSidenav_content">
    <main>
    @include('layouts.includes.admin-topnav')
    <div class="content-wrap">
    @if (Session::has('success'))
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
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
    </main>

    </div>
</div>
<footer class="footer">

</footer>

<!---============================ Write All PopUp's here ============================-->

<!-- Begin Join Meeting Popup -->
<div class="modal fade joinMeetingModal" id="joinMeetingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-5">
      <div class="modal-body text-center">
        <h2 class="secHeading">Cardio Session</h2>
        <div class="exerciseCard mb-0 bg-light">
          <a href="#" class="text-dark">https://www.w3.org/Help/Webmaster#sourceSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</a>
        </div>
        <div class="text-right"><a href="#" class="text-dark"><i class="fas fa-share"></i></a></div>
        <a href="join-meeting.php" class="btnStyle">Join Now</a>
      </div>
    </div>
  </div>
</div>
<!-- END Join Meeting Popup -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>

  <!-- Calandar JS -->
  <script src="https://unpkg.com/@fullcalendar/core@4.3.0/main.min.js"></script>
  <script src="https://unpkg.com/@fullcalendar/interaction@4.3.0/main.min.js"></script>
  <script src="https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.js"></script>
  <script src="https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.js"></script>
  <script src="https://unpkg.com/@fullcalendar/list@4.3.0/main.min.js"></script>

  <!-- Calandar JS -->

  <script src="{{asset('themes/admin/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{asset('themes/admin/vendor/clock-picker/clockpicker.js')}}"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="{{ asset('themes/admin/js/slick.min.js') }}"></script>
  <script src="{{ asset('themes/admin/js/scripts.js') }}"></script>
  <script src="{{ asset('themes/admin/js/custom.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

  @stack('custom-js-scripts')
    @yield('js')
</body>

</html>
