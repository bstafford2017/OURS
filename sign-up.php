<!DOCTYPE html>
<html>
    <head>
        <title>OURS</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="css/sign-up.css" type="text/css"/>
    </head>
    <body>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
      <script>
        $(document).ready(function(){
          $('#signup_form').on('submit', function(){

            // Check if passwords match
            var password = $('#password').val();
            var con_password = $('#confirm-password').val();
            if(password != con_password){
              alert("Passwords do not match.");
              exit();
            }
            
            // Check password length with Regular Expression
            var pass_regex = /\w\w\w\w\w\w\w*/;
            var result = pass_regex.exec(password);
            if(result != password){
              alert("Password must be at least 7 characters long.");
              exit();
            }
            
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
                   alert("Account Successfully Created.");
                 }
             }).fail(function(data) {
                 alert( "Account Creation Failed.");
             });
             // to prevent refreshing the whole page page
             return false;
          });
        });
      </script>
        <center>
        <br><br><h2 id="welcome">Welcome to the Online University Registration System!</h2><br>
          <form id="signup_form">
            <h1>Register</h1>
            <p><small><b>Fill up the following details to register.</b></small><br><br>

            Name:<br>
            <input type="text" placeholder="Enter Name" id="name" required><br><br>

            Username:<br>
            <input type="text" placeholder="Enter Username" id="username" required><br><br>

            <!--<center>Email:<br>
            <input type="text" placeholder="Enter Email" id="email" required><br>
            -->

            Password:<br>
            <input type="password" placeholder="Enter Password" id="password" required><br><br>
                
            Confirm Password:<br>
            <input type="password" placeholder="Enter Confirm Password" id="confirm-password" required><br><br>

            Status:
            <select>
              <option value="student">Student</option>
              <option value="staff">Staff</option>
              <option value="faculty">Faculty</option>
            </select><br><br>
				
            <input id="submit-button" type="submit" value="Create An Account">
            <a href="index.php" style="text-decoration:none;">
              <input type="button" value="Back" href="index.php" formnovali>
            </a>
          </form>
        </center>

        <h6 id="footer"> <b>Contact Us:</b><br>
        Phone: xxx-xxx-xxxx<br>
        Email: us@university.edu<br>
        Address: 1111 North St.<br>State, US 50000<br>
        </h6>
        
        <?php
        // Check if current username is being used
        if(isset($_POST['submit-button'])){
          $first = $_POST['username'];
          $check = "SELECT * FROM users WHERE name = '$username'";
          $result = mysqli_query($con, $check);
          if($result->num_rows >= 0){
            echo '<script type="text/javascript"> alert("Invalid Username.") </script>';
          } 
        }
        ?>
    </body>
</html>

