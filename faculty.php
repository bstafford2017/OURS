<!DOCTYPE html>
<html>
    <head>
        <title>OURS</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="css/faculty.css" type="text/css"/>
    </head>
    <body>
        <h2 id="welcome">Welcome User!</h2>
        <?php include("navbar.php"); ?>

        <div id="main-container">
            <h2 class="header" style="">My Search</h2>
            <div id="search-container">
               <input id="search" type="text" placeholder="Search for a faculty member . . ." required>
               <input id="submit-button" type="submit" value="Submit">
            </div>

            <div>
              <table id = "faculty-search-result">
                <thead>

                </thead>

                <tbody>
                </tbody>
              </table>

            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
        <script>
        $(document).ready(function(){

            $.ajax({
              type : 'POST',
              contentType: "application/json",
              url: 'api/faculty/search.php'
            }).done(function(response){
              // alert("working");
              th = '<tr><th>'+"Name" +'</th>';
              th += '<th>'+"Position" +'</th>';
              th += '<th>'+"Office Address" +'</th>';

              // data = $.parseJSON(response);
              tr = '';
              $.each(response, function(i, item) {
                // alert(item.name);
                tr += '<tr><td><a href=facultyDetails.php?name='+(item.name)+'>'+item.name+'</a></td>';
                tr += '<td>'+item.position +'</td>';
                tr += '<td>'+item.offcie_addr+'</td></tr>';
              });

              $('#faculty-search-result > thead').empty().append(th);
              $('#faculty-search-result').find('tbody').empty().append(tr);

            }).fail(function(){
              alert("failed..");
            });
            return false;

        });

        $('#submit-button').click(function() {
            $.ajax({
                type: 'GET',
                contentType: "application/json",
                url: 'api/faculty/search_one.php',
                data : {
                    'name' : $('#search').val()
                }
            }).done(function(response){
              //alert("working");
              $("#faculty-search-result").find("tr:gt(0)").empty();

              //alert("name ? "+response.name);
              var tblRow='';
              tblRow = '<tr><td><a href=facultyDetails.php?name='+(response.name)+'>'+response.name+'</a></td>';
              tblRow += '<td>'+response.position +'</td>';
              tblRow += '<td>'+response.offcie_addr+'</td></tr>';
              //alert(tblRow);
              // // $('#faculty-search-result > thead').html("");
              $('#faculty-search-result').find('tbody').append(tblRow);
            }).fail(function(){
                alert("No results for search");
            });

            return false;
        });
        </script>

        <script type="text/javascript" src="js/Pagination.js"></script>

        <?php include('footer.php'); ?>
    </body>
</html>
