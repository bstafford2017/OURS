<!DOCTYPE html>
<html>
    <head>
        <title>OURS</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
        <link rel="stylesheet" href="css/faculty.css" type="text/css"/>
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

        <div id="main-container">
            <h2 class="header" style="">My Search</h2>
            <div id="search-container">
                <form>
                    <input id="search" type="text" placeholder="Search for a faculty member . . ." required>
                    <input id="submit-button" type="submit" value="Submit">
                </form>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
        <script>
        $(document).ready(function(){
            $('#submit-button').click(function() {
                $.ajax({
                    type: 'GET',
                    contentType: "application/json",
                    url: 'api/faculty/search.php',
                    data : {
                        name : $('#search').val()
                    }
                }).done(function(resposne){
                    //  $.each(response, function(index) {
                    //    alert(response[index].isbn);
                    //
                    //    tr += "<tr><td><input type='checkbox' id='mycheckbox' value='"+(response[index].isbn)+"'></td>";
                    //    tr += '<td><a href=bookDetailsPage.php?isbn='+(response[index].isbn)+'>'+response[index].title+'</a></td>';
                    //    tr += '<td><input type="text" name = "quantity"></td>';
                    //    //"'+quantity[response[index].isbn]+'"
                    //    tr+= '</tr>';
                    // });
                    //
                    // $('#bookTable').html(tr);
                }).fail(function(){
                    alert("No results for search");
                });
            });
        });
        </script>

        <h6 id="footer"> <b>Contact Us:</b><br>
        Phone: xxx-xxx-xxxx<br>
        Email: us@university.edu<br>
        Address: 1111 North St.<br>State, US 50000<br>
        </h6>
    </body>
</html>
