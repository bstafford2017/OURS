<!DOCTYPE html>
<html>
    <head>
        <title>OURS</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
        <link rel="stylesheet" href="css/index.css" type="text/css"/>
    </head>
    <body>
        <h3 id="welcome">Welcome to the Online University Registration System!</h3>
        <form id="sign-in-form">
            <b>Username:</b><br>
            <input type="text" id="username" required><br>
             <b>Password:</b><br>
            <input type="text" id="password" required><br>
            <input type="submit" id="submit" value="Submit" required><br>
            <a href="sign-up.php">Do not have an account? Sign up today!</a>
        </form>
        <h6 id="footer"> <b>Contact Us:</b><br>
        Phone: xxx-xxx-xxxx<br>
        Email: us@university.edu<br>
        Address: 1111 North St.<br>State, US 50000<br>
        </h6>
        <?php
        // Needs merge with API
        if(isset($_POST['button'])){
            $first = $_POST['first'];
            $last = $_POST['last'];
            $check = "SELECT * FROM users WHERE first = '$first' AND last = '$last'";
            $result = mysqli_query($con, $check);
            if($result->num_rows <= 0){
                $sql = "INSERT INTO users VALUES ('$first', '$last')";
                if(mysqli_query($con, $sql)){
                    echo 'Success!';
                } else {
                    echo '<script type="text/javascript"> alert("Invalid") </script>';
                }
            } else {
                echo '<script type="text/javascript"> alert("This name already exists in the database!") </script>';
            }
        }
        ?>
    </body>
</html>