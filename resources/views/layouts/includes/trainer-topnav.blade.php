<nav class="sb-topnav navbar navbar-expand">
    <div class="container-fluid">
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <h2 style="width: 100%"> @yield('page-title')</h2>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item">
                @php
                    $prefix       = Request::route()->getPrefix();
                    $prefix       = str_replace('/', '', $prefix);
                    $unread_count = App\Models\Notification::where([['receiver_id', Auth::id()], ['is_read', 0]])->count();
                @endphp
                <a class="nav-link notiBell" href="{{ route($prefix . '.notification') }}"><i
                        class="fas fa-bell"></i><span>{{ isset($unread_count) ? $unread_count : 0 }}</span></a>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img src="{{ isset(Auth::user()->trainer->photo) ? asset(Auth::user()->trainer->photo) : asset('themes/customer/assets/images/profileImg.jpg')  }}" class="userImg rounded-circle" alt="">

{{--                    <img src="{{ $user->photo ? asset($user->photo) : asset('themes/customer/assets/images/profileImg.jpg')  }}" class="userImg rounded-circle" alt="">--}}

                    {{Auth::user()->name.''.Auth::user()->last_name}}
{{--                    {{$user->name.' '.$user->last_name}}--}}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">

                    <a class="dropdown-item" style="cursor: pointer;" data-toggle="modal" data-target="#changePassword">Change Password</a>
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
    </div>
</nav>

<!-- Password reset Modal -->
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
                            <input id="old_password" type="password" class="form-control" name="old_password"
                                autocomplete="current-password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password"
                                autocomplete="current-password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>

                        <div class="col-md-6">
                            <input id="password_confirmation" type="password" class="form-control"
                                name="password_confirmation" autocomplete="current-password">
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
