<!DOCTYPE html>
<html>
    <head>
        <title>OURS</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
        <link rel="stylesheet" href="css/main.css" type="text/css"/>
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

        <div id="schedule">
            <h2 class="header">My Schedule</h2>
            <div class="big-table">
                <table>
                    <?php
                    /*
                    $command = "SELECT name, class_time, instructor_id, credits FROM courses";
                    $result = mysqli_query($con, $command); // need $con 
                    if($result->num_rows > 0){
                        echo '<tr>';
                        echo '<th>Name</th><th>Time</th><th>Professor</ht>';
                        echo '</tr>';
                        while($row = $result->fetch_assoc()){
                            echo '<tr>';
                            echo '<td>'. $row["name"] . '</td><td>' . $row["class_time"] 
                            .'</td><td>' . $row["instructor id"] . '</td>';
                            echo'</tr>';
                        }
                        echo '</table>';
                    } else {
                        echo 'You have no courses';
                    }*/
                    echo '<h2 style="font-size:25px;">You have no courses</h2>';
                    ?>
                    
                </table>
            </div>
        </div>

        <div id="deadlines">
            <h3 class="header">My Deadlines</h3>
            <div class="table">
                
            </div>
        </div>

        <div id="holds">
            <h3 class="header">My Holds</h3>
            <div class="table">

            </div>
        </div>

        <div id="advisor">
            <h3 class="header">My Advisor</h3>
            <div class="table">

            </div>
        </div>

        <h6 id="footer"> <b>Contact Us:</b><br>
        Phone: xxx-xxx-xxxx<br>
        Email: us@university.edu<br>
        Address: 1111 North St.<br>State, US 50000<br>
        </h6>
    </body>
</html>
