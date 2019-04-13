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
            <li><a href="">Home</a></li>
            <li><a href="">Courses</a></li>
            <li><a href="">Teachers</a></li>
            <li><a href="">Faculty</a></li>
            <li><a href="">Settings</a></li>
            <li style="float:right"><a href="index.php">Logout</a></li>
        </ul>

        <h6 id="footer"> <b>Contact Us:</b><br>
        Phone: xxx-xxx-xxxx<br>
        Email: us@university.edu<br>
        Address: 1111 North St.<br>State, US 50000<br>
        </h6>

        <?php
            $command = "SELECT name, class_time, instructor_id, credits FROM courses";
            $result = mysqli_query($command);
            if($result->num_rows > 0){
                echo '<table style="width:50%;"><tr>';
                echo '<th>Name</th><th>Time</th><th>Professor</ht>';
                echo '</tr>';
                while($row = $result->fetch_assoc()){
                    echo '<tr>'
                    echo '<td>'. $row["name"] . '</td><td>' . $row["class_time"] 
                    .'</td><td>' . $row["instructor id"] . '</td>';
                    echo'</tr>'
                }
                echo '</table>'
            } else {
                echo '<h6>You have no courses</h6>';
            }
        ?>
    </body>
</html>
