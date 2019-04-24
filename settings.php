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
                <input type="submit" value="Submit">
            </form>
        </div>
        </center>

       <?php include('footer.php'); ?>

        <!-- <?php
        // if(isset($_POST['submit'])){
        //     $name = $_POST['name'];
        //     $username = $_POST['username'];
        //     $password = $_POST['password'];
        //     $confirm = $_POST['confirm-password'];
        //     if($password != $confirm){
        //         echo '<script type="text/javascript">alert("Passwords do not match.");</script>';
        //     } else {
        //         echo 'TEST';
        //     }
        // }
        ?> -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
        <script>
            $(document).ready(function() {
                $('#submit').click(function(){

                    // Check data first??
                    // Get rid of php that checks input??

                    $.ajax({
                        type: 'GET',
                        contentType: "application/json",
                        url: 'api/settings/update.php',
                        data : {
                            name: $('#name').val()
                            username: $('#usernmae').val()
                            password: $('password').val()
                            confirm-password: $('confirm-password').val()
                        }
                    }).done(function(){
                        alert("Successfully updated user information");
                    }).fail(function(){
                        alert("Failed to update user information");
                    });
                });
            });
        </script>

    </body>
</html>
