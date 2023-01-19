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
            <h2 class="text-center"> Dear User.</h2>           
           Fitzen Studion invited you to join the team as Trainer.
            <br>
            please click Join Now button below to proceed.
            <a href = "{{url('complete-registration?token='.$token)}}" >Join Now</a> 
        </div>
</body>
</html>