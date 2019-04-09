<!DOCTYPE html>
<html>
    <head>
        <title>OURS</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="css/sign-up.css" type="text/css"/>
    </head>
    <body background= "http://www.cashadvance6online.com/data/archive/img/2871699048.jpeg">
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

        <br><br><center><h2><big><font color="white">Welcome to the Online University Registration System!</font></big></h2></br></br>
          <form id="signup_form">
            <div style="background-color:lightblue; height: 450px; width: 450px; border: solid black;">
              <center><h1>Register</h1>
              <center><p><small><b>Fill up the following details to register.</b></small>
              <hr/>
              <center>Name:<br>
              <input type="text" placeholder="Enter Name" id="name" required><br>
              <center>Email:<br>
              <input type="text" placeholder="Enter Email" id="email" required><br>
              <center>Password:<br>
              <input type="text" placeholder="Enter Password" id="password" required><br>
			        <center>Confirm Password:<br>
              <input type="text" placeholder="Enter Confirm Password" id="confirm-password" required><br><br>
              <center>Status:
              <select>
                <option value="student">Student</option>
                <option value="staff">Staff</option>
                <option value="faculty">Faculty</option>
              </select><br><br>
            <input type="submit" value="Create An Account"><br>
          </div>
        </form>
      </div>
    </body>


</html>
