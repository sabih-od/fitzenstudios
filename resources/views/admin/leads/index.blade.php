@extends('layouts.admin-portal')
@section('page-title')
    Leads
@endsection

@section('style')
    <style>
        .userCard .delBtn.inrBtn a {
            border-radius: 100%;
            background: rgb(238 170 27 / 25%);
            color: var(--theme-color);
            border: none;
            height: 35px;
            width: 35px;
        }
    </style>
@endsection

@section('content')
<main>
    <div class="content-wrap">
        <div class="row">
            <div class="col-md-6">
                <h2 class="secHeading">Leads</h2>
            </div>
            {{-- <div class="col-md-6 text-right">
                <button class="btnStyle addUserBtn" data-toggle="modal" data-target="#exampleModal">ADD Lead
                </button>
            </div> --}}
        </div>

        <div class="row align-items-center mt-4">
            @foreach($leads as $lead)
                <div class="col-md-4">
                    <div class="userCard">
                        <div class="delBtn inrBtn">
                            @if($lead->is_customer == 0)
                                <a href="{{ url('admin/permanent-customer/'.$lead->id) }}">
                                    {{-- <i class="far fa-eye"></i> --}}
                                    <i class="fa fa-user-plus"></i>
                                </a>
                            @endif
                            <button class="editLeads" data-toggle="modal" data-target="#editModal" data-id ="{{$lead->id}}" data-fname ="{{$lead->first_name}}" data-lname ="{{$lead->last_name}}" data-email ="{{$lead->email}}"
                                data-phone ="{{$lead->phone}}" data-age ="{{$lead->age}}" data-gender ="{{$lead->gender}}" data-note ="{{$lead->note}}">
                                <i class="far fa-edit"></i>
                            </button>
                            <a href="javascript:(void)" onclick="Delete({{ $lead->id }});" style="all: unset;">
                            <button>
                                    <i class="fas fa-trash"></i>
                            </button>
                                <form action="{{ route('leads.destroy',$lead->id) }}" method="POST" style="display: none;"
                                      id="delete-form-{{ $lead->id }}"  >
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </a>
                        </div>

                        {{-- <a href="lead-details.php"> --}}
                            <div class="content">
                                <h3>{{$lead->first_name.' '.$lead->last_name}}</h3>
                                <p>{{$lead->age}} , {{$lead->email}}</p>
                            </div>

                        {{-- </a> --}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Add Lead</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('leads.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <input placeholder="First Name" name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input placeholder="Last Name"  name="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required>
                        @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input placeholder="Email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input placeholder="Phone" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input placeholder="Age" type="number" name="age" max="99" class="form-control @error('age') is-invalid @enderror" value="{{ old('age') }}" required>
                        @error('age')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select name="gender" id="" class="form-control @error('gender') is-invalid @enderror" value="{{ old('gender') }}" required>
                            <option selected disabled>Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        @error('gender')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <textarea name="note" cols="30" placeholder="Note" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btnStyle">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Edit Lead</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="editLead">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <input id="editFname" placeholder="First Name" name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="editLname" placeholder="Last Name"  name="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required>
                        @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="editEmail" placeholder="Email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="editPhone" placeholder="Phone" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="editAge" placeholder="Age" type="number" name="age" max="99" class="form-control @error('age') is-invalid @enderror" value="{{ old('age') }}" required>
                        @error('age')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select id="editGender" name="gender" id="" class="form-control @error('gender') is-invalid @enderror" value="{{ old('gender') }}" required>
                            <option selected disabled>Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        @error('gender')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <textarea id="editNote" name="note" cols="30" placeholder="Note" class="form-control"></textarea>
                    </div>
                    <button class="btnStyle" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-js-scripts')
    <script>
        $( ".editLeads" ).click(function() {
            var id = $(this).data('id');
            var fname = $(this).data('fname');
            var lname = $(this).data('lname');
            var email = $(this).data('email');
            var phone = $(this).data('phone');
            var age = $(this).data('age');
            var gender = $(this).data('gender');
            var note = $(this).data('note');

            $('#editFname').val(fname);
            $('#editLname').val(lname);
            $('#editEmail').val(email);
            $('#editPhone').val(phone);
            $('#editAge').val(age);
            $('#editGender').val(gender);
            $('#editNote').val(note);
            $("#editLead").attr('action', "{{url('admin/leads')}}/"+id);
        });

        function Delete(id){
            if (confirm("Are you sure to delete?")) {
                event.preventDefault();
                document.getElementById('delete-form-' + id).submit();
            }
            return false;
        }
    </script>
@endpush
