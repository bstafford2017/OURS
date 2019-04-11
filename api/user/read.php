<?php

  include_once '../config/db.php';
  include_once '../objects/user.php';

  // get database connection
  $database = new Database();
  $db = $database->getConnection();

  // instantiate user object
  $user = new User($db);

  $query = $user -> read();
  $num = $query -> rowCount();

  if($num>0){
    $arr = array();
    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      $each = array("userid" => $userid, "name" => $username, "email" => $userEmail);
      array_push($arr, $each);
    }
    http_response_code(200);
    echo json_encode($arr);

  } else{
    http_response_code(404);
    echo json_encode(array("message"=> "NOT FOUND"));
  }

 ?>
