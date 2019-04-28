<?php
  include_once '../config/db.php';
  include_once '../objects/cart.php';
  include_once '../objects/course.php';

  // get database connection
  $database = new Database();
  $db = $database->getConnection();

  // instantiate cart object
  $cart = new Cart($db);
  $course = new Course($db);

  $cart->user_id = $_GET['user_id'];

  $query = $cart->read();
  $num = $query -> rowCount();

  if($num>0){
    // $arr = array();
    $arr = array();
    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      // echo "course id : ".$row['course_id'].", user id : ". $row['user_id'];
      $course->id = $row['course_id'];

      $course->read_one();
      if($course->name!=null){
        $each = array(
        "id" =>  $course->id,
        "name" => $course->name,
        "class_time" => $course->class_time);
        array_push($arr, $each);

      } else{
        // http_response_code(404);
        // echo json_encode(array("message"=> "NOT FOUND"));
      }
    }
    http_response_code(200);
    echo json_encode($arr);

  } else{
    http_response_code(404);
    echo json_encode(array("message"=> "NOT FOUND"));
  }


?>
