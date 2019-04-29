
<?php
  $name = $_GET['name'];
?>
<html>
    <head>
        <title>OURS</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="css/facultyDetails.css" type="text/css"/>
    </head>
    <body>
        <h2 id="welcome">Welcome User!</h2>

        <?php include("navbar.php"); ?>
        <div id = "content">
          <h2 class="header">My Faculty Member</h2>
          <div id="content-subcontainer">
            <table id = "faculty_basic_info">
              <thead>

              </thead>
              <tbody>

              </tbody>
            </table>

            <br/><br/>
            <strong>Biography </strong><br/>
            <p id="biography"></p>
            <strong>Research Interest</strong> <br/>
            <p id ="research_interest"></p>
            <strong>Education </strong><br/>
            <p id ="education"></p>

          </div>
        </div>

        <?php include('footer.php'); ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
        <script>
        $(document).ready(function() {
            //alert("start serach?");
            var name = "<?php echo $name; ?>";

            $.ajax({
              type: 'GET',
              contentType: "application/json",
              url: 'api/faculty/search_one.php',
              data : {
                'name' : name
              }

            }).done(function(response){

              var th = '';
              th += '<tr><td>'+"Name" +'</td>';
              th += '<td>'+"Position" +'</td>';
              th += '<td>'+"Offcie Address"+'</td></tr>';

              var tr ='';
              tr += '<tr><td>'+response.name +'</td>';
              tr += '<td>'+response.position +'</td>';
              tr += '<td>'+response.offcie_addr +'</td></tr>';

              $('#faculty_basic_info > thead').empty().append(th);
              $('#faculty_basic_info > tbody').empty().append(tr);
              $('#biography').append(response.biography);
              $('#research_interest').append(response.interest);
              $('#education').append(response.education);


            }).fail(function(){
              alert("failed to read list from the system");
            });


            return false;
        });
        </script>


    </body>
</html>
