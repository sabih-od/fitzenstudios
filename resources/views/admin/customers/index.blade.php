@extends('layouts.admin-portal')
@section('page-title')
Customers
@endsection

@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('build/css/intlTelInput.css') }}">
<link rel="stylesheet" href="{{ asset('build/css/demo.css') }}">
<style>
    .userCard .delBtn.inrBtn a {
        border-radius: 100%;
        background: rgb(238 170 27 / 25%);
        color: var(--theme-color);
        border: none;
        height: 40px;
        width: 40px;
    }
    label {
        float: left;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    .iti--allow-dropdown {
        width: 100% !important;
    }

</style>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-6">
            <h2 class="secHeading">Customers</h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="#" class="btnStyle addUserBtn addBtn">ADD Customers</a>
             <!-- Modal -->
             @php $timezones = App\Models\TimeZone::all(); @endphp
            <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalHeaderText">Add New Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ url('admin/customer-register') }}" >
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">First name<span style="color: red">*</span></label>
                                            <input id="f_name" type="text" class="form-control @error('f_name') is-invalid @enderror" name="f_name"
                                                value="{{ old('f_name') }}" required autocomplete="f_name" autofocus
                                                placeholder="First Name">
                                            @error('f_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Last Name<span style="color: red">*</span></label>
                                            <input id="l_name" type="text" class="form-control @error('l_name') is-invalid @enderror" name="l_name"
                                                value="{{ old('l_name') }}" required autocomplete="l_name" autofocus
                                                placeholder="Last Name">
                                            @error('l_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="emailAddress">Email Address<span style="color: red">*</span></label>
                                            <input type="email" maxlength="30" class="form-control  @error('email') is-invalid @enderror" name="email"
                                                id="register-email" aria-describedby="register-email" value="{{ old('email') }}" placeholder="your email" required>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password<span style="color: red">*</span></label>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="new-password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="timezone">Time Zone<span style=" color: red">*</span></label>
                                            <select name="time_zone" id="time_zone" required class=" form-control">
                                                <option value="">Select Time Zone</option>
                                                @forelse ($timezones as $time)
                                                <option value="{{ $time->timezone_value }}">
                                                    {{ $time->zone_name.' '.$time->time_zone }}</option>
                                                @empty
            
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label style="display:block;" for="phone">Phone<span style=" color: red">*</span></label>
                                            <input type="tel" name="phone" class="form-control" required id="phone" style="width: 100% !important">
                                            @if ($errors->has('phone'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="message">Message</label>
                                            <textarea name="message" class="form-control" rows="4" cols="50"></textarea>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Add Customer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row align-items-center mt-4">
        @foreach($customers as $customer)
            <div class="col-md-4 col-sm-6">
                <a href="{{ url('admin/customer-detail/'.$customer->id) }}" class="userCard">
                    <div class="delBtn inrBtn">
                        <button onclick="CustomerDetail({{$customer->id}})">
                            <i class="fas fa-ban"></i>
                        </button>
                        <button onclick="Delete({{$customer->id}});">
                            <i class="fas fa-trash"></i>
                        </button>
                        <form action="{{ url('admin/customer/delete/'.$customer->id) }}" method="POST" style="display: none;"
                            id="delete-form-{{$customer->id}}">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                        </form>
                    </div>

                    <div class="imgWrap">
                        @if(isset($customer->photo))
                            <img src="{{ asset($customer->photo) }}" alt="">
                        @else
                            <img src="{{ asset('themes/customer/assets/images/default-user.jpg') }}" alt="">
                        @endif

                    </div>
                    <div class="content">
                        <h3>{{$customer->first_name.' '.$customer->last_name}}</h3>
                        <p>{{$customer->age}}, {{$customer->residence}}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

@endsection

@push('custom-js-scripts')

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('build/js/intlTelInput.js')}}"></script>

<script type="text/javascript">

    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
        utilsScript: "{{ asset('build/js/utils.js')}}",
    });

    $('body').on('click', '.addBtn', function () {
        $("#pkid").val(0);
        $("#trainer_name").val('');
        $("#email").val('');
        $("#modalHeaderText").text('Add New Trainer');
        $('#AddModal').modal('show');
    });
    function Delete(id) {
        if (confirm("Are you sure you want to delete this customer?")) {
            event.preventDefault();
            document.getElementById('delete-form-' + id).submit();
        }
        return false;
    }

    function CustomerDetail(customer_id) {
        window.location.href = `{{ url('admin/customer-detail/`+customer_id+`') }}`;
    }

</script>
@endpush