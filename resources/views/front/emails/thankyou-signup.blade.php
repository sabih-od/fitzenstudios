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
            <h2 class="text-center">Fitzen Studio - Thank you for Signing Up</h2>
            Thank you for showing interest in Fitzen Studios. <br >
            Your request has been received and someone from our team will be contacting you soon.
            <a href = "{{ url('customer/dashboard') }}" >Go To Dashboard</a> 
        </div>
</body>
</html>