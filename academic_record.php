<html>
  <head>
    <style>
      table, th, td{

        text-align: center;
        border-collapse: collapse;
        border: 1px solid black;
      }

      table{
        color : white;
        float: left;
        height: 20%;
        width: 100%;
        background-color: rgb(0,0,0,0.75);
        box-shadow: 0px 8px 16px 0px rgb(0,0,0,0.5);
      }
    </style>
  </head>

  <body>

    <div>
      <input type ="submit" id ="view_record" value= "VIEW RECORD">
      <input type ="submit" id ="view_my_advisee" value ="VIEW MY ADVISEE">
    </div>

    <div>
      <table id = "record">
        <thead>
        </thead>
        <tbody>
        </tbody>

      </table>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
    <script src = "js/cookie.js"></script>

    <script>
      $(document).ready(function(){

        var jwt = getCookie('jwt');
        $.ajax({
          type: 'POST',
          url: 'api/utils/validate_token.php',
          data : JSON.stringify({
            'jwt' : jwt
          })
        }).done(function(result){
          alert(result.data.status);
          if(result.data.status == "staff"){
            alert("You have no authority to see this information.");
            location.replace("main.php");
          }
          //
          jwt_id = result.data.id;

          // if status -> student
          // show olny their RECORD
          if(result.data.status =="student"){
            alert("you are a student");
            $('#view_record').show();
            $('#view_my_advisee').hide();
          }
          // if status -> professor
          // show only their advisee records
          if(result.data.status =="faculty"){
            alert("you are a faculty");
            $('#view_record').hide();
            $('#view_my_advisee').show();
          }

        }).fail(function(){
          alert("You have to login first");
          location.replace("index.php");
        });



        return false;

      });

      $('#view_record').click(function(){
        $.ajax({
          type : 'GET',
          url : 'api/record/read_one.php',
          data :{
            'id' : jwt_id
          }
        }).done(function(response){
          alert(response);

          var data = $.parseJSON(response);
          th ='';
          th += '<tr><td>'+"course id"+'</td>';
          th += '<td>'+"course name"+'</td>';
          th += '<td>'+"completion"+'</td>';
          th += '<td>'+"enrollment"+'</td>';
          th += '<td>'+"registration"+'</td></tr>';

          tr ='';
          $.each(data, function(i,item){
            tr += '<tr><td>'+item.course_id+'</td>';
            tr += '<td>'+item.cname+'</td>';

            if(item.isCompleted == 0){
              tr += '<td>'+"not completed"+'</td>';
            } else{
                tr += '<td>'+"completed"+'</td>';
            }
            if(item.isEnrolled == 0){
              tr += '<td>'+"not enrolled"+'</td>';
            } else{
                tr += '<td>'+"enrolled"+'</td>';
            }
            if(item.isRegistered == 0){
              tr += '<td>'+"not registered"+'</td>';
            } else{
                tr += '<td>'+"registered"+'</td>';
            }

          });

          $('#record > thead').empty().append(th);
          $('#record > tbody').empty().append(tr);

        }).fail(function(){
          alert("failed to read academic record");
        });

        return false;
      });

      $('#view_my_advisee').click(function(){
        $.ajax({
          type : 'GET',
          url : 'api/aa/read.php',
          data : {
            id : jwt_id
          }
        }).done(function(response){
          //alert("response?");
          var data = $.parseJSON(response);

          var th ='';
          th += '<tr><td>'+"student id"+ '</td>';
          th += '<td>'+"student name"+ '</td></tr>';

          var tr = '';
          $.each(data, function(i,item){
            tr += '<tr><td><a href=academicDetails.php?id='+(item.advisee_id)+'>'+item.advisee_id + '</a></td>';
            tr += '<td>'+item.advisee_name +'</td></tr>';

          });
          $('#record > thead').empty().append(th);
          $('#record > tbody').empty().append(tr);

        }).fail(function(){
          alert("failed to read records");
        });
      });


    </script>
    <?php include('footer.php'); ?>


  </body>

</html>
