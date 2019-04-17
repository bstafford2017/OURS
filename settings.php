<!DOCTYPE html>
<html>
    <head>
        <title>OURS</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
        <link rel="stylesheet" href="css/settings.css" type="text/css"/>
    </head>
    <body>
        <h2 id="welcome">Welcome User!</h2>
        <ul>
            <li><a href="main.php">Home</a></li>
            <li><a href="courses.php">Courses</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="faculty.php">Faculty</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li style="float:right"><a href="index.php">Logout</a></li>
        </ul>

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

        <h6 id="footer"> <b>Contact Us:</b><br>
        Phone: xxx-xxx-xxxx<br>
        Email: us@university.edu<br>
        Address: 1111 North St.<br>State, US 50000<br>
        </h6>

        <?php
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirm = $_POST['confirm-password'];
            if($password != $confirm){
                echo '<script type="text/javascript">alert("Passwords do not match.");</script>';
            } else {
                echo 'TEST';
            }
        }
        ?>

    </body>
</html>
