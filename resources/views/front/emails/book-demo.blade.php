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
            Thank you so much for joining us. <br >
            In order to continue please click on Book Demo Button           
            to fill the demo session form.
            <br>
            <a href = "{{url('book-demo')}}" >Book Demo</a> 
        </div>
</body>
</html>