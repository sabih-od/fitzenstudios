@extends('layouts.trainer')
@section('page-title')
Meeting
@endsection
@section('style')

@endsection
@section('content')
<main>
    <div class="content-wrap meeting-wrap">
        <div class="row">
            <div class="col-md-12">
                <h2 class="secHeading">Join Meeting</h2>
            </div>
            <div class="col-md-12">
                <div class="meet-video-wrap">
                    <img src="{{ asset('assets/images/videoCall.jpg')}}" alt="">
                </div>
            </div> 
            

            <div class="col-12">
                <div class="btnCont">
                    <a href="dashboard.php" class="btnStyle">Cancel Meeting</a>
                    <a href="dashboard.php" class="btnStyle">Complete Meeting</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
    <script>
    
    </script>
@endsection