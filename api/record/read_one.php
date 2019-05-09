<?php
  include_once '../config/db.php';
  include_once '../objects/record.php';

  // get database connection
  $database = new Database();
  $db = $database->getConnection();

  // instantiate object
  $record = new Record($db);

  $record->student_id = $_GET['id'];

  $query = $record->read();
  $num = $query -> rowCount();

  if($num>0){
    // $arr = array();
    $arr = array();
    while($row = $query->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $each = array(
        "course_id" =>  $course_id,
        "student_id" => $student_id,
        "cname" => $cname,
        "isCompleted" => $isCompleted,
        "isEnrolled" => $isEnrolled,
        "isRegistered" => $isRegistered
        );
        array_push($arr, $each);

    }
    http_response_code(200);
    echo json_encode($arr);

  } else{
    http_response_code(404);
    echo json_encode(array("message"=> "NOT FOUND"));
  }


?>
