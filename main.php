<!DOCTYPE html>
<html>
    <head>
        <title>OURS</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="css/main.css" type="text/css"/>
    </head>
    <body>
        <h2 id="welcome">Welcome User!</h2>

        <?php include("navbar.php"); ?>
        <div id = "content"></div>

        <?php include('footer.php'); ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
        <script>
          $(document).ready(function(){

            //alert("document is ready?");
            var jwt = getCookie('jwt');
            $.ajax({
              type: 'POST',
              url: 'api/utils/validate_token.php',
              data : JSON.stringify({
                'jwt' : jwt
              })
            }).done(function(result){
              $('#content').load("html/home.html");
                // alert(result.data.id);

                // home page html will be here
            }).fail(function(){
              alert("You have to login first");
              location.replace("index.php");
            });

              return false;
          });


        </script>
        <script src = "js/cookie.js"></script>

    </body>
</html>
