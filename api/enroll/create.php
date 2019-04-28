<?php
  include_once '../config/db.php';
  include_once '../objects/enroll.php';

  // get database connection
  $database = new Database();
  $db = $database->getConnection();

  // instantiate cart object
  $enroll = new Enroll($db);

  // get posted data
  $data = json_decode(file_get_contents("php://input"));

  //set product property values

  foreach($data as $each){
    $enroll->user_id = (int)$each->user_id;
    $enroll->course_id = (int)$each->course_id;

    $isEnrolled = $enroll->create();
    if($isEnrolled){
      http_response_code(200);
      // can be changed
      echo json_encode(array(
             "course_id" => $enroll->course_id,
             "user_id" => $enroll->user_id
      ));

    }else{
      http_response_code(401);
      echo json_encode(array("message" => "Enrolling course failed.",
      "user_id_input" => $enroll->user_id, "course_id_input"=> $enroll->course_id
      ));
    }
  }


 ?>
