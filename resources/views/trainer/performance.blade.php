@extends('layouts.trainer')
@section('page-title')
Performance
@endsection
@section('style')
@endsection
@section('content')
    <main>
        <div class="content-wrap">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="secHeading">Performance </h2>
                </div>
                {{-- <div class="col-md-6">
                    <div class="d-flex filter">
                        <a href="javascript:;" class="active">All</a>
                        <a href="javascript:;">Month</a>
                        <a href="javascript:;">Week</a>
                        <a href="javascript:;">Date</a>
                    </div>
                </div> --}}
                <div class="col-md-12">
                    @forelse ($upcoming_sessions as $item)
                        <div class="performCard">
                            <div class="dateWrap">
                                <h2>{{ date('d', strtotime($item->trainer_date))}}<span>{{ date('M', strtotime($item->trainer_date))}}</h2>
                            </div>

                            <h3><span>Time</span> {{date("h:i ", strtotime($item->trainer_time ))}}; </h3>

                            <h3><span>Customer</span>{{ $item["customer"]->first_name.' '.$item["customer"]->last_name }}</h3>

                            <div class="statusBox">
                                <span>Status</span>
                                <ul>
                                    @if($item->status == "upcoming" )
                                        <li><span class="bg-primary">{{ ucfirst($item->status) }}</span></li>
                                    @elseif($item->status == "completed")
                                        <li><span class="bg-success">{{ ucfirst($item->status) }}</span></li>
                                    @elseif($item->status == "canceled")
                                        <span class="badge badge-danger" style="color: #fff !important;">{{ ucfirst($item->status) }}</span>
                                    @elseif($item->status == "re_scheduled")
                                        <span class="bg-warning">{{ ucfirst($item->status) }}</span>
                                    @endif
                                </ul>
                            </div>


                                <!-- Modal -->

                            <a href="{{ url('trainer/performance-detail/'.$item->id) }}" class="btnStyle">VIEW DETAILS</a>
                        </div>
                    @empty
                        <h2 style="text-align: center">No Performances Available..!!</h2>
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
