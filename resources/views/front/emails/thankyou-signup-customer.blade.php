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
            <h2 class="text-center">Fitzen Studio - Registration</h2>
            Thank you for showing interest in Fitzen Studios. <br >
            You are registered as a customer at Ftizen Studio.<br >
            Your login Credentials are 
            <p>Email: {{ $to }}</p>
            <p>Password: {{ $pass }}</p>
        </div>
</body>
</html>