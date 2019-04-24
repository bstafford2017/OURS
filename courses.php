<!DOCTYPE html>
<html>
    <head>
        <title>OURS</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="css/courses.css" type="text/css"/>
    </head>
    <body>
        <h2 id="welcome">Welcome User!</h2>
        <?php include("navbar.php"); ?>

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

        <div id="search-result-container">
          <table id="search-result-list">
            <thead>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
        <script>
          $(document).ready(function(){

            $.ajax({
                type: 'POST',
                contentType: "application/json",
                url: 'api/department/read.php'
              }).done(function(data){

                data = $.parseJSON(data);
                $('#department_list').empty();
                $('#department_list').append("<option>"+"SELECT"+"</option>");

                $.each(data, function(i, item) {
                  $('#department_list').append("<option value ='"+item.dept_id+"'>"+item.dept_name+"</option>");
                });
              }).fail(function(){
                alert("failed to read list from the system");
              });
            return false;
        });
        $('#getSearch').click(function(){
          $.ajax({
            type: 'GET',
            contentType: "application/json",
            url: 'api/course/search.php',
            data : {
              course_id : $('#course-id').val(),
              course_name : $('#course-name').val(),
              dept : $('#department_list option:selected').val()
            }
          }).done(function(response){
            th = '<tr><th>'+"course id" +'</th>';
            th += '<th>'+"course name" +'</th>';
            th += '<th>'+"days & times" +'</th>';
            th += '<th>'+"classroom" +'</th>';
            th += '<th>'+"units" +'</th></tr>';

            tr ='';
            $.each(response, function(i, item) {
              tr += "<tr><td>"+item.id+"</td>";
              tr += '<td><a href=courseDetails.php?id='+(item.id)+'>'+item.cname+'</a></td>';
              tr += '<td>'+item.class_time+'</td>';
              tr += '<td>'+item.classroom_id+'</td>';
              tr += '<td>'+item.credits+'</td></tr>';
            });
            $('#search-result-list > thead').empty().append(th);
            $('#search-result-list').find('tbody').empty().append(tr);

          }).fail(function(){
            alert("fail to search");
          });

          return false;

        });
        </script>

        <div id="cart-container">
            <h2 class="header" style="">My Cart</h2>
            <div id="cart">
                None
            </div>
        </div>

        <?php include('footer.php'); ?>
    </body>
</html>
