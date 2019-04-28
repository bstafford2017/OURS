<!DOCTYPE html>
<html>
    <head>
        <title>OURS</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="css/index.css" type="text/css">
    </head>
    <body>
        <center>
        <br><br><h2 id="welcome">Welcome to the Online University Registration System!</h2><br>
        <form id="sign-in-form">
            <h1>Login</h1>
            Username:<br>
            <input type="text" id="username" placeholder="Enter Username" required><br><br>
            Password:<br>
            <input type="password" id="password" placeholder="Enter Password" required><br><br><br>
            <input type="submit" id="submit" value="Submit" required><br><br><br>
            <a href="sign-up.php">Do not have an account? Sign up today!</a>
        </form>
        </center>

        <h6 id="footer"> <b>Contact Us:</b><br>
        Phone: xxx-xxx-xxxx<br>
        Email: us@university.edu<br>
        Address: 1111 North St.<br>State, US 50000<br>
        </h6>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
        <script>
          $(document).ready(function(){

            $('#sign-in-form').on('submit', function(){
              $.ajax({
                   type: 'POST',
                   contentType: "application/json",
                   url: 'api/signin.php',
                   data : JSON.stringify({
                     username : $('#username').val(),
                     password : $('#password').val()
                   })
               }).done(function(data){
                   if(data){
                     // login success
                     // set jwt in cookie
                     //alert(data.jwt);

                     setCookie("jwt", data.jwt, 1);
                     location.replace("main.php");
                   }

               }).fail(function() {
                   alert( "login failed.");
               });
               // to prevent refreshing the whole page page
               return false;

            });
          });

        </script>
        <script src = "js/cookie.js"></script>

    </body>
</html>
