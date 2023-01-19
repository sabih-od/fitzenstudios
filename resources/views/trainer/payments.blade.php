@extends('layouts.trainer')
@section('page-title')
    Payments
@endsection
@section('style')

@endsection
@section('content')
<main>

    <div class="content-wrap">
        <div class="row">
            <div class="col-md-6">
                <h2 class="secHeading">My Payments</h2>
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
                <div class="table-responsive">
                    <table class="table table-striped text-center">
                        <thead>
                        <tr class="thead-dark">
                            <th><span>No.</span></th>
                            <th><span>Slip</span></th>
                            <th><span>Payment Date</span></th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $item)
                                <tr>

                                    <td><span>{{ $loop->iteration }}</span></td>
                                    <td><span><a href="{{ asset($item->slip) }}" target="blank">View Payment Slip</a></span></td>
                                    <td><span>{{ date('d-m-Y', strtotime($item->created_at)) }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td style="text-align: center" colspan="3">No Payments Available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
   
@endsection