<!DOCTYPE html>
<html>
    <head>
        <title>OURS</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
        <link rel="stylesheet" href="css/courses.css" type="text/css"/>
    </head>
    <body>
        <h2 id="welcome">Welcome User!</h2>
        <ul>
            <li><a href="main.php">Home</a></li>
            <li><a href="courses.php">Courses</a></li>
            <li><a href="faculty.php">Faculty</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li style="float:right"><a href="index.php">Logout</a></li>
        </ul>

        <div id="search-container">
            <h2 class="header" style="">Course Search</h2>
            <div id="search">
                <form>
                    Course ID:<br>
                    <input id="course-id" type="text" placeholder="Enter Course ID"><br><br>
                    Course Name:<br>
                    <input id="course-name" type="text" placeholder="Enter Course Name"><br><br>
                    Department:<br>
                    <select>
                        <?php
                            // Get departments from DB
                        ?>
                    </select>
                    <input id="submit-button" type="submit" value="Search">
                </form>
            </div>
        </div>

        <?php
            // Find all courses for searched item
        ?>
        
        <div id="cart-container">
            <h2 class="header" style="">My Cart</h2>
            <div id="cart">
                None
            </div>
        </div>

        <h6 id="footer"> <b>Contact Us:</b><br>
        Phone: xxx-xxx-xxxx<br>
        Email: us@university.edu<br>
        Address: 1111 North St.<br>State, US 50000<br>
        </h6>
    </body>
</html>
