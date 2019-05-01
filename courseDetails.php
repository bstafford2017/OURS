<?php
  $course_id = $_GET['id'];

?>


<html>
    <head>
        <title>OURS</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="css/courseDetails.css" type="text/css"/>
    </head>
    <body>
        <h2 id="welcome">Welcome User!</h2>
        <?php include("navbar.php"); ?>
        <!-- show details of each course -->
        <div id = "courseDetail_container">
          <h2 class="header">My Course Details</h2>
          <div id="course-main-container">
            <table id = "courseDetail">
              <thead>
                <th>

                </th>
              </thead>
              <tbody>
              </tbody>
            </table>
            <p id = "courseDetailHead">
            </p>
            <p id = "courseDetails">
            </p>
          </div>
          <center><input id="putCart" type="submit" value="PUT IN CART"></center>
        </div>


        <?php include("footer.php"); ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
        <script>
          $(document).ready(function(){

            // search
            $.ajax({
              type: 'GET',
              contentType: "application/json",
              url: 'api/course/search.php',
              data : {
                course_id : <?php echo $course_id; ?>
              }
            }).done(function(response){
              th = '<tr><th>'+"course id" +'</th>';
              th += '<th>'+"course name" +'</th>';
              th += '<th>'+"days & times" +'</th>';
              th += '<th>'+"classroom" +'</th>';
              th += '<th>'+"units" +'</th></tr>';

              tr='';
              description_title ='description';
              $.each(response, function(i, item) {
                tr += "<tr><td>"+item.id+"</td>";
                tr += '<td><a href=courseDetails.php?id='+(item.id)+'>'+item.cname+'</a></td>';
                tr += '<td>'+item.class_time+'</td>';
                tr += '<td>'+item.classroom_id+'</td>';
                tr += '<td>'+item.credits+'</td></tr>';
                description = item.course_description;
              });

              $('#courseDetail > thead').empty().append(th);
              $('#courseDetail').find('tbody').empty().append(tr);

              $('#courseDetailHead').html(description_title);
              $('#courseDetails').html(description);

            }).fail(function(){
              alert("fail");
            });

          });

          $('#putCart').click(function(){
            // get jwt decoded first
            if(confirm("Are you sure?")){
              //alert("here");
              var jwt = getCookie('jwt');
              $.ajax({
                type: 'POST',
                url: 'api/utils/validate_token.php',
                data : JSON.stringify({
                  'jwt' : jwt
                })
              }).done(function(result){
                alert("granted");
                $.ajax({
                  type: 'POST',
                  url: 'api/cart/create.php',
                  data : JSON.stringify({
                    'user_id' : result.data.id,
                    'course_id' : <?php echo $course_id; ?>
                  })
                }).done(function(response){
                  alert("Course is now in cart");
                }).fail(function(){
                  alert("Failed to register class");
                });


              }).fail(function(){
                alert("You have to login first");
                location.replace("index.php");
              });



          }else{
            alert("");
          }

          });
        </script>
        <script src = "js/cookie.js"></script>
    </body>

</html>
