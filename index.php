<!DOCTYPE html>
<html>
    <head>
        <title>OURS</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
        <link rel="stylesheet" href="css/index.css" type="text/css"/>
    </head>
    <body>
        <center>
        <br><br><h2>Welcome to the Online University Registration System!</h2>
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

        <?php
        // Needs merge with API
        if(isset($_POST['button'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $check = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            $result = mysqli_query($con, $check);
            if($result->num_rows <= 0){
                $sql = "INSERT INTO users VALUES ('$first', '$last')";
                if(mysqli_query($con, $sql)){
                    echo 'Success!';
                    header("Location: main.php");
                } else {
                    echo '<script type="text/javascript"> alert("Invalid username/password.") </script>';
                }
            } else {
                echo '<script type="text/javascript"> alert("This name already exists in the database!") </script>';
            }
        }
        ?>
    </body>
</html>
