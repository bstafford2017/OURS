<!DOCTYPE html>
<html>
    <head>
        <title>OURS</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="css/courses.css" type="text/css"/>
    </head>
    <body>
        <h2 id="welcome">Welcome User!</h2>
        <ul class="navbar">
            <li><a href="main.php">Home</a></li>
            <li><a href="courses.php">Courses</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="faculty.php">Faculty</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li style="float:right"><a href="index.php">Logout</a></li>
        </ul>

        <div id="search-container">
            <h2 class="header" style="">Course Search</h2>
            <div id="search">
                <form id ="search-form">
                    Course ID:<br>
                    <input id="course-id" type="text" placeholder="Enter Course ID"><br><br>
                    Course Name:<br>
                    <input id="course-name" type="text" placeholder="Enter Course Name"><br><br>
                    Department:<br>
                    <select id ="department_list">
                       <option value="0">- Select -</option>
                    </select>
                    <input id="getSearch" type="submit" value="Search">
                </form>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
        <script>
          $(document).ready(function(){

            $('.navbar').on('click', 'a', function (e) {
               console.log('this is the click');
               e.preventDefault();
               $.ajax({
                   type: 'POST',
                   contentType: "application/json",
                   url: 'api/department/read.php'
                 }).done(function(data){
                   alert("succeed to department list");

                   data = $.parseJSON(data);

                   $.each(data, function(i, item) {
                     $('#department_list').append("<option value ='"+item.dept_id+"'>"+item.dept_name+"</option>");

                   });

                 }).fail(function(){
                   alert("failed to read list from the system");
                 });
               return false;
            });

            // Search
            $('#getSearch').click(function(){
              // search

              $.ajax({
                type: 'GET',
                contentType: "application/json",
                url: 'api/course/search.php',
                data : {
                  course_name : $('#course-name').val()

                }

              }).done(function(response){
                alert("working?");
                //alert(response);
                var tr = '';
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
                alert("fail to search");
              });

              return false;

            });


        });
        </script>

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
