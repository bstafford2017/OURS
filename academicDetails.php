<?php
  $id = $_GET['id'];
 ?>

<html>
  <head>

  </head>

  <body>
    <div>
      <table id = "record">
        <thead>
        </thead>
        <tbody>
        </tbody>

      </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
    <script>
      $(document).ready(function(){
        var id = <?php echo $id; ?>

        $.ajax({
          type : 'GET',
          url : 'api/record/read_one.php',
          data :{
            'id' : id
          }

        }).done(function(response){
          //alert("working");
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
          alert("fail to read student's academic record");
        });

      });


    </script>

  </body>

</html>
