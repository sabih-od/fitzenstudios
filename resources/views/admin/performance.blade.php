

@extends('layouts.admin-portal')
@section('page-title')
    Training Sessions
@endsection
@section('style')

@endsection
@section('content')
    <main>
        <div class="content-wrap">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="secHeading">Training Sessions </h2>
                </div>

                <div class="col-md-12">
                    @forelse ($upcoming_sessions as $item)
                        <div class="performCard">
                            <div class="dateWrap">
                                <h2>{{ date('d', strtotime($item->trainer_date))}}<span>{{ date('M', strtotime($item->trainer_date))}}</h2>
                            </div>


                            <h3><span>Time</span>{{ date("h:i A", strtotime($item->trainer_time ))}}</h3>
                            <h3><span>Customer</span>{{ $item["customer"]->first_name.' '.$item["customer"]->last_name }}</h3>

                            <div class="statusBox">
                                <span>Status</span>
                                <ul>
                                    @if($item->status == "upcoming" )
                                        <li><span class="bg-primary" style="padding: 0.2em 1rem;color: var(--white);">{{ ucfirst($item->status) }}</span></li>
                                    @elseif($item->status == "completed")
                                        <li><span class="bg-success" style="padding: 0.2em 1rem;color: var(--white);">{{ ucfirst($item->status) }}</span></li>
                                    @elseif($item->status == "cancelled")
                                        <span class="badge badge-danger" style="padding: 0.2em 1rem;color: var(--white);" style="color: #fff !important;">{{ ucfirst($item->status) }}</span>
                                    @elseif($item->status == "re_scheduled")
                                        <span class="bg-warning" style="padding: 0.2em 1rem;color: var(--white);">{{ ucfirst($item->status) }}</span>
                                    @endif
                                </ul>
                            </div>
                        @if($item->status !== "completed")
                            <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btnStyle" data-toggle="modal"
                                        data-target="#exampleModal{{ $loop->iteration }}">
                                    Update Session Status
                                </button>
                            @else
                                <button type="button" class="btn btn-primary btnStyle" disabled>
                                    Update Session Status
                                </button>
                        @endif

                        <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('admin/update-session-status') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="session_id" value="{{ $item->id }}">
                                                <select name="status" class="form-control">
                                                    <option value="upcoming">Upcoming</option>
                                                    <option value="completed">Completed</option>
                                                    <option value="cancelled">Cancelled</option>
                                                </select><br>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ url('admin/performance-detail/'.$item->id) }}" class="btnStyle">VIEW DETAILS</a>
                        </div>
                    @empty
                        <h2 style="text-align: center">NO Session Available..!!</h2>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script>

    </script>
@endsection


