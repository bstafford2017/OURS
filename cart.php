<!DOCTYPE html>
<html>
    <head>
        <title>OURS</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="css/cart.css" type="text/css"/>
    </head>
    <body>
        <h2 id="welcome">Welcome User!</h2>
        <?php include("navbar.php"); ?>

        <div id="cart-container">
          <h2 class="header">My Cart</h2>
          <table id = "cart-list">
              <thead>
              </thead>
              <tbody>
              </tbody>
          </table>
          <input type = "submit" id ="enroll" value = "ENROLL">
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
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

              $.ajax({
                type: 'GET',
                contentType: "application/json",
                url: 'api/cart/read.php',
                data : {
                  'user_id' : result.data.id
                }
              }).done(function(response){
                //alert("we do have list in cart");
                th = '<tr><th>'+"course id" +'</th>';
                th += '<th>'+"course name" +'</th>';
                th += '<th>'+"days & times" +'</th>';

                data = $.parseJSON(response);
                tr = '';
                $.each(data, function(i, item) {
                  tr += '<tr><td>'+item.id +"</td>";
                  tr += '<td>'+item.name +'</td>';
                  tr += '<td>'+item.class_time+'</td></tr>';
                });
                $('#cart-list > thead').empty().append(th);
                $('#cart-list').find('tbody').empty().append(tr);

              }).fail(function(){
                // alert("nothing in cart");
              });

            }).fail(function(){
              alert("You have to login first");
              location.replace("index.php");
            });

            return false;
          });


          $('#enroll').click(function(){
            if(confirm("Are you sure to enroll?")){
              var jwt = getCookie('jwt');

              $.ajax({
                type: 'POST',
                url: 'api/utils/validate_token.php',
                data : JSON.stringify({
                  'jwt' : jwt
                })
              }).done(function(result){
                alert("jwt");
                var cartlist = new Array();

                $('#cart-list tr').each(function(row, tr){
                    cartlist[row]={
                        "course_id" : $(tr).find('td:eq(0)').text(),
                        "course_name" :$(tr).find('td:eq(1)').text(),
                        "user_id" : result.data.id
                    }
                });
                cartlist.shift();  // first row is the table header - so remove

                $.ajax({
                  type: 'POST',
                  contentType: "application/json",
                  url: 'api/enroll/create.php',
                  data : JSON.stringify(cartlist)


                }).done(function(response){
                  alert("Classes are now enrolled.");
                }).fail(function(){
                  alert("failed to enroll");
                });


              }).fail(function(){
                alert("You have to login first");
                location.replace("index.php");
              });
                return false;

            } else{
                return false;
            }


          });
        </script>

        <?php include('footer.php'); ?>
        <script src = "js/cookie.js"></script>
    </body>
</html>
