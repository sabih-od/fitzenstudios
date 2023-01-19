@extends('layouts.customer')
@section('page-title')
    Notifications
@endsection
@section('style')

@endsection
@section('content')
<main style="padding: 70px">
    <div id="content">
        
    </div>
</main>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            {{ session()->forget('notification_count') }}
            $.ajax({
                url:'{{ route("getNotification") }}',
                type:'get',
                // dataType:'json',
                success:function (response) {
                    if(response != 'error'){
                        $('#content').html(response);
                    }
                }
            });
        });

        setInterval(function(){
            $.ajax({
                url:'{{ route("getNotification") }}',
                type:'get',
                // dataType:'json',
                success:function (response) {
                    if(response != 'error'){
                        $('#content').html(response);
                    }
                }
            });
        }, 15000);
    </script>
@endsection