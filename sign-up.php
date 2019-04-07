<!DOCTYPE html>
<html>
    <head>
        <title>OURS</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
        <link rel="stylesheet" href="sign-up.css" type="text/css"/>
    </head>
    <body>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
      <script>
        $(document).ready(function(){

          $('#signup_form').on('submit', function(){
            $.ajax({
                 type: 'POST',
                 contentType: "application/json",

                 url: 'api/user/create.php',
                 data : JSON.stringify({
                   name : $('#name').val(),
                   email : $('#email').val(),
                   password : $('#password').val(),
                   confirmPwd : $('#confirm-password').val()
                 })
             }).done(function(data){
                 if(data){
                   // successfully sing up
                   alert("successfully created");
                 }

             }).fail(function(data) {

                 alert( "failed.");
             });
             // to prevent refreshing the whole page page
             return false;

          });
        });

      </script>

        <h3>Welcome to the Online University Registration System!</h3>
        <form id="signup_form">
            Name:<br>
            <input type="text" id="name" required><br>
            Email:<br>
            <input type="text" id="email" required><br>
            Password:<br>
            <input type="text" id="password" required><br>
			      Confirm Password:<br>
            <input type="text" id="confirm-password" required><br>
            <input type="submit" value="Create An Account"><br>
        </form>
    </body>


</html>
