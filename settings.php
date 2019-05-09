<!DOCTYPE html>
<html>
    <head>
        <title>OURS</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="css/settings.css" type="text/css"/>
    </head>
    <body>
        <h2 id="welcome">Welcome User!</h2>
        <?php include("navbar.php"); ?>

        <center>
        <h2 class="header" style="position:relative;right: 98px;">My Information</h3>
        <div id="container">
            <h2 class="header">Update Information</h3>
            <form>
                Name:<br>
                <input id="name" type="text" placeholder="Enter Name" required><br><br>
                Username:<br>
                <input id="username" type="text" placeholder="Enter Username" required><br><br>
                Password:<br>
                <input id="password" type="password" placeholder="Enter Password" required><br><br>
                Confirm Password:<br>
                <input id="confirm-password" type="password" placeholder="Enter Confirm Password" required><br><br><br>
                <input id ="edit_userinfo" type="submit" value="Submit">
            </form>
        </div>
        </center>

       <?php include('footer.php'); ?>


       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
       <script src = "js/cookie.js"></script>

       <script>
        $(document).ready(function(){

          var jwt = getCookie('jwt');

          $.ajax({
            type: 'POST',
            url: 'api/utils/validate_token.php',
            data : JSON.stringify({
              'jwt' : jwt
            })
          }).done(function(result){
            jwt_id = result.data.id;
            jwt_name = result.data.name;
            jwt_usernmae = result.data.username;

            $('#name').val(result.data.name);
            $('#username').val(result.data.username);

          }).fail(function(){
            alert("You have no authority to change private information");

          });

          return false;
        });

        $('#edit_userinfo').click(function(){
          var password = $('#password').val();
          var con_password = $('#confirm-password').val();
          if(password != con_password){
            alert("Passwords do not match.");
            exit();
          }

          // check there is any changes
          name = $('#name').val();
          username = $('#username').val();

          if(name == jwt_name && username  == jwt_usernmae){
            alert("No changes");
          } else{

            $.ajax({
              type : 'POST',
              url : 'api/user/update.php',
              data :{
                'id' : jwt_id,
                'name' : name,
                'username' : username
              }
            }).done(function(response){

              $('#name').val(name);
              $('#username').val(username);

            }).fail(function(){
              alert("failed to change info");
            });
          }

          return false;

        });
       </script>





     </body>
</html>
