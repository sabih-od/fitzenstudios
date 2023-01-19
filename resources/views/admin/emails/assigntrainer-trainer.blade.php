<!doctype html>
<html>
<body>
    <style>
        .contactPage {
            padding: 70px 180px;
        }
        a:link, a:visited {
            background-color: #f79f2c;
            color: white;
            padding: 14px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        a:hover, a:active {
            background-color: red;
        }
    </style>
        <div class="contactPage">
            <h2 class="text-center"> Dear {{ $name }}.</h2>           
            This email is to inform you that you are assigned to customers for training session.
            <p><strong>Start Date: </strong>{{ $start_date }}</p>
            <p><strong>Start Time: </strong>{{ $start_time }}</p>
            <a href="{{ $start_url }}">Click Here to start the meeting</a>
        </div>
</body>
</html>