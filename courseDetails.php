<?php
  $course_id = $_GET['id'];

?>


<html>
    <head>
        <title>OURS</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="css/courses.css" type="text/css"/>
    </head>
    <body>
        <h2 id="welcome">Welcome User!</h2>
        <?php include("navbar.php"); ?>
        <!-- show details of each course -->
        <div>
          <table id = "courseDetail">
            <thead>

            </thead>
            <tbody>
            </tbody>
          </table>
          <p id = "courseDetailHead">
          </p>
          <p id = "courseDetails"></p>
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
        </script>
    </body>

</html>
