<!doctype html>
<html>
<body>
    <style>
        .contactPage {
            padding: 70px 180px;
        }
    </style>
        <div class="contactPage">
            <h2 class="text-center">Session Request!</h2>
            <div style="margin-bottom: 20px;">
                <strong>Username: </strong> <span> {{ $first_name.' '.$last_name ?? ''}}</span>
            </div>
            <div style="margin-bottom: 20px;">
                <strong>Email: </strong> <span> {{ $email ?? ''}}</span>
            </div>
            <div style="margin-bottom: 20px;">
                <strong>Phone: </strong> <span> {{ $phone ?? ''}}</span>
            </div>
            <div style="margin-bottom: 20px;">
                <strong>Session Date: </strong> <span> {{ date('d-m-Y', strtotime($session_date)) ?? ''}}</span>
            </div>
            <div  style="margin-bottom: 20px;">
                <strong>Session Time: </strong> <span> {{ date('H:i', strtotime($session_time)) ?? ''}}</span>
            </div>
             <div  style="margin-bottom: 20px;">
                <strong>Goals: </strong> <span> {{ $goals ?? ''}}</span>
            </div>
           <div style="margin-bottom: 20px;">
                <strong>Message: </strong> <span> {{ $user_message ?? ''}}</span>
            </div>
        </div>
</body>
</html>